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
			if(isset($_COOKIE['name'])){ 
				$showInstructions = 0;
			} 
			$serie = $this->terman_model->verSerie($codigo);
			$a = $this->terman_model->obtenerDatos($codigo);
			$idAplicacion = $a->idAplicacion;
			$acabo = $a->acabo;
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
					$this->terman_model->actualizarPreguntaSesion($codigo,0); //contador a 0
					setcookie('name', '', time() - 1000);
					$showInstructions = 1;
					$pregunta = $this->terman_model->verPregunta($codigo);
					$progreso = $this->terman_model->verPregunta($codigo);
					$aux = array_search($serie, $numero);
					$aux = $aux+1;
					$serie = $numero[$aux];
					$limite = $this->terman_model->verLimite($codigo,$serie);
					$this->terman_model->cambiarSerie($codigo,$serie);
					$a = $this->terman_model->obtenerDatos($codigo);
					$acabo = $a->acabo;
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
					'acabo_tiempo' => $acabo,
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
			$this->terman_model->actualizarPreguntaSesion($codigo,1);
			$idAplicacion = $this->terman_model->verCodigoSesion($codigo);
			$finSesion = $_POST['finSesion'] / 1000;
			$finSesion = date("Y-m-d H:i:s ", $finSesion);
			if ($this->input->is_ajax_request() && $idAplicacion) {
			 	$this->terman_model->guardarFinSesion($codigo,$finSesion);
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
				$this->terman_model->insertarRespuesta($idReactivo,$idAplicacion,"'X'");
			}
			$this->terman_model->actualizarPregunta($buscarPreguntaMaxima+1,$idAplicacion);
			$this->terman_model->actualizarPreguntaSesion($codigo,0);
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
			$CA = $I+$II+$III+$IV+$V+$VI+$VII+$VIII+$IX+$X;
			$CI = self::obtenerCI($CA);
			
			$res[] = array("serie" => "I","valor" => $I);
			$res[] = array("serie" => "II","valor" => $II);
			$res[] = array("serie" => "III","valor" => $III);
			$res[] = array("serie" => "IV","valor" => $IV);
			$res[] = array("serie" => "V","valor" => $V);
			$res[] = array("serie" => "VI","valor" => $VI);
			$res[] = array("serie" => "VII","valor" => $VII);
			$res[] = array("serie" => "VIII","valor" => $VIII);
			$res[] = array("serie" => "IX","valor" => $IX);
			$res[] = array("serie" => "X","valor" => $X);
			$res[] = array("serie" => "CI","valor" => $CI);
			$res[] = array("serie" => "CA","valor" => $CA);
			
			for($i = 0; $i < sizeof($res); $i++){
				$calif[] = array("serie" => $res[$i]['serie'],"calificacion" => self::obtenerCalificacion($res[$i]['serie'],$res[$i]['valor']));
			}
			print_r($res);
			print_r('<br>');
			print_r($calif);
			
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

		public function obtenerCI($r){
			if($r >= 67 && $r <= 69){return 80;}
			if($r >= 70 && $r <= 71){return 81;}
			if($r >= 72 && $r <= 74){return 82;}
			if($r >= 75 && $r <= 76){return 83;}
			if($r >= 77 && $r <= 80){return 84;}
			if($r >= 81 && $r <= 82){return 85;}
			if($r >= 83 && $r <= 85){return 86;}
			if($r == 86){return 87;}
			if($r >= 87 && $r <= 90){return 88;}
			if($r >= 91 && $r <= 93){return 89;}
			if($r >= 94 && $r <= 96){return 90;}
			if($r >= 97 && $r <= 99){return 91;}
			if($r >= 100 && $r <= 102){return 92;}
			if($r >= 103 && $r <= 104){return 93;}
			if($r >= 105 && $r <= 106){return 94;}
			if($r >= 107 && $r <= 110){return 95;}
			if($r >= 111 && $r <= 113){return 96;}
			if($r >= 114 && $r <= 116){return 97;}
			if($r >= 117 && $r <= 119){return 98;}
			if($r >= 120 && $r <= 123){return 99;}
			if($r >= 124 && $r <= 125){return 100;}
			if($r >= 126 && $r <= 129){return 101;}
			if($r >= 130 && $r <= 133){return 102;}
			if($r >= 134 && $r <= 137){return 103;}
			if($r >= 138 && $r <= 141){return 104;}
			if($r >= 142 && $r <= 145){return 105;}
			if($r >= 146 && $r <= 149){return 106;}
			if($r >= 150 && $r <= 153){return 107;}
			if($r >= 154 && $r <= 157){return 108;}
			if($r >= 158 && $r <= 159){return 109;}
			if($r >= 160 && $r <= 162){return 110;}
			if($r >= 163 && $r <= 166){return 111;}
			if($r == 167){return 112;}
			if($r >= 168 && $r <= 170){return 113;}
			if($r >= 171 && $r <= 173){return 114;}
			if($r >= 174 && $r <= 175){return 115;}
			if($r >= 176 && $r <= 177){return 116;}
			if($r >= 178 && $r <= 180){return 117;}
			if($r >= 181 && $r <= 183){return 118;}
			if($r >= 184 && $r <= 185){return 119;}
			if($r == 186){return 120;}
			if($r == 187){return 121;}
			if($r == 188){return 122;}
			if($r == 189){return 123;}
			if($r == 190){return 124;}
			if($r == 191){return 125;}
			if($r == 192){return 126;}
			if($r == 193){return 127;}
			if($r == 194){return 128;}
			if($r == 195){return 129;}
			if($r == 196){return 130;}
			if($r == 197){return 131;}
			if($r == 198){return 132;}
			if($r == 199){return 133;}
			if($r == 200){return 134;}
			if($r == 201){return 135;}
			if($r == 202){return 136;}
			if($r == 203){return 137;}
			if($r == 204){return 138;}
			if($r == 205){return 139;}
			if($r == 206){return 140;}
			if($r == 207){return 141;}
		}

		public function obtenerCalificacion($serie,$valor){
			switch($serie){
				case 'I';
				if($valor == 16){ return 'Sobresaliente'; }
				if($valor == 15){ return 'Superior'; }
				if($valor == 14){ return 'Termino Medio Alto'; }
				if($valor == 12 || $valor == 13){ return 'Termino Medio'; }
				if($valor == 10 || $valor == 11){ return 'Termino Medio Bajo'; }
				if($valor == 8 || $valor == 9){ return 'Inferior'; }
				if($valor <= 7){ return 'Deficiente'; }
			break;
				case 'II';
				if($valor == 22){ return 'Sobresaliente'; }
				if($valor == 20){ return 'Superior'; }
				if($valor == 18){ return 'Termino Medio Alto'; }
				if($valor >= 12 && $valor <= 16){ return 'Termino Medio'; }
				if($valor == 10){ return 'Termino Medio Bajo'; }
				if($valor == 8){ return 'Inferior'; }
				if($valor <= 6){ return 'Deficiente'; }
			break;
				case 'III';
				if($valor == 29 || $valor == 30){ return 'Sobresaliente'; }
				if($valor == 27 || $valor == 28){ return 'Superior'; }
				if($valor >= 23 && $valor <= 26){ return 'Termino Medio Alto'; }
				if($valor >= 14 && $valor <= 22){ return 'Termino Medio'; }
				if($valor == 12 || $valor == 13){ return 'Termino Medio Bajo'; }
				if($valor >= 8 && $valor <= 11){ return 'Inferior'; }
				if($valor <= 7){ return 'Deficiente'; }
			break;
				case 'IV';
				if($valor == 18){ return 'Sobresaliente'; }
				if($valor == 16 || $valor == 17){ return 'Superior'; }
				if($valor == 14 || $valor == 15){ return 'Termino Medio Alto'; }
				if($valor >= 10 && $valor <= 13){ return 'Termino Medio'; }
				if($valor >= 7 && $valor <= 9){ return 'Termino Medio Bajo'; }
				if($valor == 6){ return 'Inferior'; }
				if($valor <= 5){ return 'Deficiente'; }
			break;
				case 'V';
				if($valor == 24){ return 'Sobresaliente'; }
				if($valor == 20 || $valor == 22){ return 'Superior'; }
				if($valor == 16 || $valor == 18){ return 'Termino Medio Alto'; }
				if($valor == 12 || $valor == 14){ return 'Termino Medio'; }
				if($valor == 8 || $valor == 10){ return 'Termino Medio Bajo'; }
				if($valor == 6){ return 'Inferior'; }
				if($valor <= 4){ return 'Deficiente'; }
			break;
				case 'VI';
				if($valor == 20){ return 'Sobresaliente'; }
				if($valor == 18 || $valor == 19){ return 'Superior'; }
				if($valor >= 15 && $valor <= 17){ return 'Termino Medio Alto'; }
				if($valor >= 9 && $valor <= 14){ return 'Termino Medio'; }
				if($valor == 7 || $valor == 8){ return 'Termino Medio Bajo'; }
				if($valor == 5 || $valor == 6){ return 'Inferior'; }
				if($valor <= 4){ return 'Deficiente'; }
			break;
				case 'VII';
				if($valor == 19 || $valor == 20){ return 'Sobresaliente'; }
				if($valor == 18){ return 'Superior'; }
				if($valor == 16 || $valor == 17){ return 'Termino Medio Alto'; }
				if($valor >= 9 && $valor <= 15){ return 'Termino Medio'; }
				if($valor >= 6 && $valor <= 8){ return 'Termino Medio Bajo'; }
				if($valor == 5){ return 'Inferior'; }
				if($valor <= 4){ return 'Deficiente'; }
			break;
				case 'VIII';
				if($valor == 17){ return 'Sobresaliente'; }
				if($valor == 15 || $valor == 16){ return 'Superior'; }
				if($valor == 13 || $valor == 14){ return 'Termino Medio Alto'; }
				if($valor >= 8 && $valor <= 12){ return 'Termino Medio'; }
				if($valor == 7){ return 'Termino Medio Bajo'; }
				if($valor == 6){ return 'Inferior'; }
				if($valor <= 5){ return 'Deficiente'; }
			break;
				case 'IX';
				if($valor == 18){ return 'Sobresaliente'; }
				if($valor == 17){ return 'Superior'; }
				if($valor == 16){ return 'Termino Medio Alto'; }
				if($valor >= 10 && $valor <= 15){ return 'Termino Medio'; }
				if($valor == 9){ return 'Termino Medio Bajo'; }
				if($valor == 7 || $valor == 8){ return 'Inferior'; }
				if($valor <= 6){ return 'Deficiente'; }
			break;
				case 'X';
				if($valor == 20 || $valor == 22){ return 'Sobresaliente'; }
				if($valor == 18){ return 'Superior'; }
				if($valor == 16){ return 'Termino Medio Alto'; }
				if($valor >= 10 && $valor <= 14){ return 'Termino Medio'; }
				if($valor == 8){ return 'Termino Medio Bajo'; }
				if($valor == 6){ return 'Inferior'; }
				if($valor <= 4){ return 'Deficiente'; }
			break;
				case 'CI';
				if($valor >= 140){ return 'Sobresaliente'; }
				if($valor >= 120 && $valor <= 139){ return 'Superior'; }
				if($valor >= 110 && $valor <= 119){ return 'Termino Medio Alto'; }
				if($valor >= 90 && $valor <= 109){ return 'Normal'; }
				if($valor >= 80 && $valor <= 89){ return 'Termino Medio Bajo'; }
				if($valor >= 70 && $valor <= 79){ return 'Inferior'; }
				if($valor <= 69){ return 'Deficiente'; }
			break;
				case 'CA';
				if($valor >= 172 && $valor <= 186){ return 'Sobresaliente'; }
				if($valor >= 151 && $valor <= 171){ return 'Superior'; }
				if($valor >= 137 && $valor <= 150){ return 'Termino Medio Alto'; }
				if($valor >= 123 && $valor <= 136){ return 'Normal'; }
				if($valor >= 102 && $valor <= 122){ return 'Termino Medio Bajo'; }
				if($valor >= 95 && $valor <= 101){ return 'Inferior'; }
				if($valor >= 67 && $valor <= 94){ return 'Deficiente'; }
			break;
			}
		}
    }
?>