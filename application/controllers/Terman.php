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
<<<<<<< HEAD
			$showInstructions = 1;
			if(isset($_COOKIE['name']))
			{ 
				$showInstructions = 0;
				// Caduca en un año 
				// setcookie('contador', $_COOKIE['contador'] + 1, time() + 365 * 24 * 60 * 60); 
				// $mensaje = 'Número de visitas: ' . $_COOKIE['contador']; 
			} 

=======
			$se = $this->terman_model->verSerie($codigo);
>>>>>>> 9b57c30e3f67a0d15484b456977f24067fcc657a
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
			$data = array(
				'nombre' => $a->nombre,
				'codigo' => $a->codigo,
				'idAplicacion' => $a->idAplicacion,
				'serie' => $subtest->serie,
				'instruccion' => $subtest->instruccion,
				'ejemplo' => $subtest->ejemplo,
				'idReactivo' => $datosPregunta[0]->idReactivo,
				'reactivo' => $datosPregunta[0]->reactivo,
<<<<<<< HEAD
				'datos' => $datosPregunta,
				'showInstructions' => $showInstructions,
				'duracion_en_segundos' => $subtest->tiempo,
				'fecha_fin_sesion' => date($a->finSesion),
				'acabo_tiempo' => $a->acabo
=======
				'pregunta' => $pregunta,
				'limite' => $limite,
				'indiceR' => $datosPregunta[0]->indiceR,
				'datos' => $datosRespuesta
>>>>>>> 9b57c30e3f67a0d15484b456977f24067fcc657a
			);
			$this->load->view('layout/header');
			$this->load->view('terman/test_terman',$data);
			$this->load->view('layout/footer');
		}

<<<<<<< HEAD
		public function actualizar_contador($codigo){
			$idAplicacion = $this->terman_model->verCodigoSesion($codigo);
			$contador = $idAplicacion[0]['sesion']-1;
			$contador = ($contador <= 0) ? 0 : $contador;

			if ($this->input->is_ajax_request() && $idAplicacion) {
			
				
				$this->terman_model->actualizarPregunta($codigo,$contador);
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
			print_r(true);

		}
		

=======
		public function encuesta_post($codigo){
			$opcion = $this->input->post('opcion');
			$idAplicacion = $this->input->post('idAplicacion');
			$pregunta = $this->terman_model->verPregunta($codigo);
			print_r($pregunta);
			if($opcion){
				$pregunta = $pregunta+1;
				$this->terman_model->actualizarPregunta($pregunta,$idAplicacion);
			}
		}
>>>>>>> 9b57c30e3f67a0d15484b456977f24067fcc657a
    }
?>