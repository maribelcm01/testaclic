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
					//print_r($estado);	
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

			$se = $this->terman_model->verSerie($codigo);
			$a = $this->terman_model->obtenerDatos($codigo);
			$idAplicacion = $a->idAplicacion;
			$pregunta = $this->terman_model->verPregunta($codigo);
			$limite = $this->terman_model->verLimite($codigo,$se);
			$numero = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI');
			$datosRespuesta = null;
			$datosPregunta = null;
			$subtest = null;
			if($se == ''){
				$se = $numero[1];
				$this->terman_model->cambiarSerie($codigo,$se);
			}else{
				if($se != 'XI'){
					if($pregunta > $limite){
						$this->terman_model->cambiarPregunta($codigo);
						$aux = array_search($se, $numero);
						$aux = $aux+1;
						$se = $numero[$aux];
						$this->terman_model->cambiarSerie($codigo,$se);
						setcookie('name', '', time() - 1000);
						$this->terman_model->actualizarPreguntaSesion($codigo,1); //reiniciamos sesion 0 & contador a 0
						exit;
					}
				}else{
					$this->terman_model->estadoFecha($idAplicacion);
					$datos = $this->terman_model->obtenerDatos($codigo);
					$data = array(
						'nombre' => $datos->nombre,
						'codigo' => $datos->codigo
					);
					$this->load->view('layout/header');
					$this->load->view('zavic/agradecimiento',$data);
					$this->load->view('layout/footer');
				}
			}
			if($se == 'I' || $se == 'II' || $se == 'IV' || $se == 'VII' ||$se == 'IX'){
				$datosRespuesta = $this->terman_model->obtenerRespuesta($codigo,$se);
			}
			if($se == 'III'){ $datosRespuesta[] = array('opc1' => '0', 'opc2' => '1'); }
			if($se == 'VI'){ $datosRespuesta[] = array('opc1' => 'Si', 'opc2' => 'No'); }
			if($se == 'VIII'){ $datosRespuesta[] = array('opc1' => 'V', 'opc2' => 'F'); }
			
			$subtest = $this->terman_model->datosST($se);
			$datosPregunta = $this->terman_model->obtenerPregunta($codigo,$se);
			$respuesta = $this->terman_model->verRespuesta($se,$pregunta);
			$data = array(
				'nombre' => $a->nombre,
				'codigo' => $a->codigo,
				'idAplicacion' => $a->idAplicacion,
				'serie' => $subtest->serie,
				'instruccion' => $subtest->instruccion,
				'ejemplo' => $subtest->ejemplo,
				'idReactivo' => $datosPregunta[0]->idReactivo,
				'reactivo' => $datosPregunta[0]->reactivo,
				//'datos' => $datosPregunta,
				'showInstructions' => $showInstructions,
				'duracion_en_segundos' => $subtest->tiempo,
				'fecha_fin_sesion' => date("d-m-Y   H:m:s",strtotime($a->finSesion)),
				'acabo_tiempo' => $a->acabo,
				'pregunta' => $pregunta,
				'respuesta' => $respuesta,
				'limite' => $limite,
				'indiceR' => $datosPregunta[0]->indiceR,
				'datos' => $datosRespuesta
			);
			$this->load->view('layout/header');
			$this->load->view('terman/test_terman',$data);
			$this->load->view('layout/footer');
		}

		public function encuesta_post($codigo){
			$opcion = $this->input->post('opcion');
			$idReactivo = $this->input->post('idReactivo');
			$idAplicacion = $this->input->post('idAplicacion');
			$pregunta = $this->terman_model->verPregunta($codigo);
			$se = $this->terman_model->verSerie($codigo);
			$respuesta = $this->terman_model->verRespuesta($se,$pregunta);
			if($opcion == $respuesta){
				$this->terman_model->insertarRespuesta($idReactivo,$idAplicacion,1);
			}else{
				$this->terman_model->insertarRespuesta($idReactivo,$idAplicacion,0);
			}
			$pregunta = $pregunta+1;
			$this->terman_model->actualizarPregunta($pregunta,$idAplicacion);
			print_r($respuesta);
		}

		public function actualizar_contador($codigo){
			$idAplicacion = $this->terman_model->verCodigoSesion($codigo);
			$contador = $idAplicacion[0]['sesion']-1;
			$contador = ($contador <= 0) ? 0 : $contador;

			if ($this->input->is_ajax_request() && $idAplicacion) {
				$this->terman_model->actualizarPreguntaSesion($codigo,$contador);
			}

			print_r($contador);
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
			//print_r($buscarPreguntaActual->idAplicacion);
			$idAplicacion = $buscarPreguntaActual->idAplicacion;
			$se = $this->terman_model->verSerie($codigo);
			$buscarPreguntaMaxima = $this->terman_model->verLimite($codigo,$se);
			$buscarPreguntaMaxima = ($buscarPreguntaMaxima == $buscarPreguntaActual->pregunta) ? $buscarPreguntaMaxima+1 : $buscarPreguntaMaxima ;
			$preguntas_restantes = intval($buscarPreguntaMaxima) - intval($buscarPreguntaActual->pregunta);
			
			for ($i = intval($buscarPreguntaActual->pregunta) ; $i <= intval($buscarPreguntaMaxima); $i++) {
				$idReactivo = $this->terman_model->obtenerPreguntaTerma($codigo,$se,$i);
				$idR = $idReactivo[0]->idReactivo;
				$this->terman_model->insertarRespuesta($idR,$idAplicacion,0);
				
			}

			$this->terman_model->actualizarPregunta($buscarPreguntaMaxima+1,$idAplicacion);
			
			print_r("Se agoto el tiempo");

		}

    }
?>