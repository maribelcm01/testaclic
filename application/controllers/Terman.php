<?php
    if (!defined('BASEPATH'))  exit('No direct script access allowed');
	date_default_timezone_set('America/Mexico_City');
    class Terman extends CI_Controller{
        public function __construct(){
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->model('terman_model');
		}
        public function index() {
            $data = array('mensaje' => '');
            $this->load->view('layout/header');
            $this->load->view('terman/validar',$data);
            $this->load->view('layout/footer');
        }
        public function validar(){
			$codigo = $this->input->post('codigo');
			$c = $this->terman_model->validarCodigo($codigo);
			//print_r($codigo);exit;
			if($c == null){ 
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-danger col-3 ">'.
														'El código ingresado es incorrecto'.
													'</div>'.
												'</div>');
					$this->load->view('layout/header');
					$this->load->view('terman/validar',$data);
					$this->load->view('layout/footer');
			}else{
				$idEncuesta = $this->terman_model->verIdEncuesta($codigo);
				$nombreEncuesta = $this->terman_model->verNombreEncuesta($idEncuesta);
				if($nombreEncuesta == 'Terman merril'){
					$estado = $this->terman_model->verEstado($codigo);
					if($estado == 'Finalizado'){
						$data = array('mensaje' => '<div class="row justify-content-center">'.
														'<div class="alert alert-info col-3 ">'.
															'La encuesta ya fue contestada'.
														'</div>'.
													'</div>');
						$this->load->view('layout/header');
						$this->load->view('terman/validar',$data);
						$this->load->view('layout/footer');
					}else{
						$a = $this->terman_model->obtenerDatos($codigo);
						$data = array(
							'nombre' => $a->nombre,
							'codigo' => $a->codigo
						);
						$this->load->view('layout/header');
						$this->load->view('terman/index',$data);
						$this->load->view('layout/footer');
					}
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('layout/header');
					$this->load->view('terman/validar',$data);
					$this->load->view('layout/footer');
				}
			}
		}
		public function encuesta($codigo){
			$showInstructions = 1;
			if(isset($_COOKIE['name']))
			{ 
				$showInstructions = 0;
			} 
			$serie = $this->terman_model->verSerie($codigo);
			$a = $this->terman_model->obtenerDatos($codigo);
			$idAplicacion = $a->idAplicacion;
			$pregunta = $this->terman_model->verPregunta($codigo);
			$limite = $this->terman_model->verLimite($codigo,$serie);
			$numero = array('I','II','III','IV','V','VI','VII','VIII','IX','X','XI');
			$idEncuesta = $this->terman_model->verIdEncuesta($codigo);
			$first_last = $this->terman_model->busca_menor_mayor($idEncuesta);
			$progreso = $this->terman_model->verPregunta($codigo);
			$datosRespuesta = null;
			$datosPregunta = null;
			$subtest = null;
			$respuesta = null;
			$estado = $this->terman_model->verEstado($codigo);
			if($estado == 'Finalizado'){
				$datos = $this->terman_model->obtenerDatos($codigo);
				$data = array(
					'nombre' => $datos->nombre,
					'codigo' => $datos->codigo
				);
				$this->load->view('layout/header');
				$this->load->view('terman/agradecimiento',$data);
				$this->load->view('layout/footer');
			}else{
				if($pregunta > $limite){
					$this->terman_model->cambiarPregunta($codigo);
					$pregunta = $this->terman_model->verPregunta($codigo);;
					$aux = array_search($serie, $numero);
					$aux = $aux+1;
					$serie = $numero[$aux];
					$limite = $this->terman_model->verLimite($codigo,$serie);
					$this->terman_model->cambiarSerie($codigo,$serie);
					setcookie('name', '', time() - 1000);
					$this->terman_model->actualizarPreguntaSesion($codigo,null); //reiniciamos sesion 0 & contador a 0
					$showInstructions = 1;
					if($serie == 'XI'){
						$this->terman_model->estadoFecha($idAplicacion);
						redirect(base_url('terman/encuesta/'.$codigo));
					}
				}

				if(isset($_GET['back'])){
					if($_GET['back'] == $pregunta){ 
						redirect(base_url('terman/encuesta/'.$codigo));
					}
					$pregunta = $_GET['back'];
					$datosPregunta = $this->terman_model->obtenerPreguntaBack($codigo,$serie,$pregunta);
					if($serie == 'I' || $serie == 'II' || $serie == 'VII' || $serie == 'IX'){
						$datosRespuesta = $this->terman_model->obtenerRespuestaBack($codigo,$serie,$pregunta);
						$respuesta = $this->terman_model->verSeleccion($codigo,$serie,$pregunta);
					}
					if($serie == 'IV'){
						$datosRespuesta = $this->terman_model->obtenerRespuestaBack($codigo,$serie,$pregunta);
						$x = $this->terman_model->verSeleccion($codigo,$serie,$pregunta);
						$respuesta = str_split($x);
					}
					if($serie == 'III'){
						$datosRespuesta[] = array('opc1' => '0', 'opc2' => '1');
						$respuesta = $this->terman_model->verSeleccion($codigo,$serie,$pregunta);
					}
					if($serie == 'V'){
						$respuesta = $this->terman_model->verSeleccion($codigo,$serie,$pregunta);
					}
					if($serie == 'VI'){
						$datosRespuesta[] = array('opc1' => 'SI', 'opc2' => 'NO');
						$respuesta = $this->terman_model->verSeleccion($codigo,$serie,$pregunta);
					}
					if($serie == 'VIII'){
						$datosRespuesta[] = array('opc1' => 'V', 'opc2' => 'F');
						$respuesta = $this->terman_model->verSeleccion($codigo,$serie,$pregunta);
					}
					if($serie == 'X'){
						$x = $this->terman_model->verSeleccion($codigo,$serie,$pregunta);
						$respuesta = preg_split("/-+/",$x);
					}
				}else{
					$datosPregunta = $this->terman_model->obtenerPregunta($codigo,$serie);
					if($serie == 'I' || $serie == 'II' || $serie == 'IV' || $serie == 'VII' || $serie == 'IX'){
						$datosRespuesta = $this->terman_model->obtenerRespuesta($codigo,$serie);
					}
					if($serie == 'III'){ $datosRespuesta[] = array('opc1' => '0', 'opc2' => '1'); }
					if($serie == 'VI'){ $datosRespuesta[] = array('opc1' => 'SI', 'opc2' => 'NO'); }
					if($serie == 'VIII'){ $datosRespuesta[] = array('opc1' => 'V', 'opc2' => 'F'); }
				}
				
				$subtest = $this->terman_model->datosST($serie);
				$data = array(
					'nombre' => $a->nombre,
					'codigo' => $a->codigo,
					'idAplicacion' => $a->idAplicacion,
					'serie' => $subtest->serie,
					'instruccion' => $subtest->instruccion,
					'ejemplo' => $subtest->ejemplo,
					'idReactivo' => $datosPregunta[0]->idReactivo,
					'reactivo' => $datosPregunta[0]->reactivo,
					'showInstructions' => $showInstructions,
					'duracion_en_segundos' => $subtest->tiempo,
					'fecha_fin_sesion' => date("H:i:s",strtotime($a->finSesion)),
					'acabo_tiempo' => $a->acabo,
					'pregunta' => $pregunta,
					'progreso' => $progreso,
					'limite' => $limite,
					'indiceR' => $datosPregunta[0]->indiceR,
					'datos' => $datosRespuesta,
					'respuesta' => $respuesta,
					'menor' => $first_last[0]['indice']
				);
				$this->load->view('layout/header');
				$this->load->view('terman/test_terman',$data);
				$this->load->view('layout/footer');
			}
		}
		public function encuesta_post($codigo,$is_back){
			$opcion = $this->input->post('opcion');
			$idReactivo = $this->input->post('idReactivo');
			$idAplicacion = $this->input->post('idAplicacion');
			$pregunta = $this->terman_model->verPregunta($codigo);
			$respuesta = "'".$opcion."'";
			$this->terman_model->insertarRespuesta($idReactivo,$idAplicacion,$respuesta);
			
			if($is_back == 'false'){
				$pregunta = $pregunta+1;
				$this->terman_model->actualizarPregunta($pregunta,$idAplicacion);				
			}
			print_r($respuesta);
		}

		public function actualizar_contador($codigo){
			$x = $this->terman_model->verCodigoSesion($codigo);
			$d1 = new DateTime($x[0]['finSesion']);
			$d2 = new DateTime(date('Y-m-d H:i:s'));
			$contador = $d2->diff($d1);
			print_r(json_encode($contador));
		}

		public function crear_temporizador($codigo){
			$idAplicacion = $this->terman_model->verCodigoSesion($codigo);
			$finSesion = $_POST['finSesion'] / 1000;
			$finSesion = date("Y-m-d H:i:s ", $finSesion);
			if ($this->input->is_ajax_request() && $idAplicacion) {
			 	$this->terman_model->guardarFinSesion($codigo,$finSesion,$_POST['duracion_en_segundos']);
			}
			print_r($_POST['finSesion']);
		}
		//finalizar encuesta de serie por cronometro en 0
		public function fin_encuesta_por_cronometro($codigo){
			$buscarPreguntaActual = $this->terman_model->obtenerDatos($codigo);
			$idAplicacion = $buscarPreguntaActual->idAplicacion;
			$serie = $this->terman_model->verSerie($codigo);
			$buscarPreguntaMaxima = $this->terman_model->verLimite($codigo,$serie);
			$buscarPreguntaMaxima = ($buscarPreguntaMaxima == $buscarPreguntaActual->pregunta) ? $buscarPreguntaMaxima+1 : $buscarPreguntaMaxima ;
			$preguntas_restantes = intval($buscarPreguntaMaxima) - intval($buscarPreguntaActual->pregunta);
			for ($i = intval($buscarPreguntaActual->pregunta) ; $i <= intval($buscarPreguntaMaxima); $i++) {
				$x = $this->terman_model->obtenerPreguntaTerma($codigo,$serie,$i);
				$idReactivo = $x[0]->idReactivo;
				$this->terman_model->insertarRespuesta($idReactivo,$idAplicacion,NULL);
			}
			$this->terman_model->actualizarPregunta($buscarPreguntaMaxima+1,$idAplicacion);
			print_r("Se agoto el tiempo");
		}

		public function resultados($codigo){
			$I = self::comparar($codigo,'I');
			$II = (self::comparar($codigo,'II'))*2;
			$III = self::comparar($codigo,'III');
			$IV = self::comparar($codigo,'IV');
			$V = (self::comparar($codigo,'V'))*2;
			$VI = self::comparar($codigo,'VI');
			$VII = self::comparar($codigo,'VII');
			$VIII = self::comparar($codigo,'VIII');
			$IX = self::comparar($codigo,'IX');
			$X = (self::comparar($codigo,'X'))*2;

			$resultado = $I+$II+$III+$IV+$V+$VI+$VII+$VIII+$IX+$X;
			print_r($resultado.'<br>');
			print_r($I.'<br>'.$II.'<br>'.$III.'<br>'.$IV.'<br>'.$V.'<br>'.$VI.'<br>'.$VII.'<br>'.$VIII.'<br>'.$IX.'<br>'.$X);
			
			
			
			$this->load->view('layout/header');
			$this->load->view('terman/resultados');
			$this->load->view('layout/footer');
		}

		public function comparar($codigo,$serie){
			$limite = $this->terman_model->verLimite($codigo,$serie);
			$aux = 0;
			for($i=1; $i <= $limite; $i++){
				$res = $this->terman_model->verRespuesta($codigo,$serie,$i);
				foreach ($res as $row){
					if($A[$i] = $row->correcto == $B[$i] = $row->respuesta){
						$aux = $aux+1;
					}
				}
			}
			return $aux;
		}
    }
?>