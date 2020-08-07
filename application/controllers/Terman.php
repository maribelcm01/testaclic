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
				// Caduca en un año 
				// setcookie('contador', $_COOKIE['contador'] + 1, time() + 365 * 24 * 60 * 60); 
				// $mensaje = 'Número de visitas: ' . $_COOKIE['contador']; 
			} 

			$a = $this->terman_model->obtenerDatos($codigo);
			$numero = array('','I','II','III','IV','V','VI','VII','VIII','IX','X');
			$estado = $this->terman_model->verEstado($codigo);
			if($estado == 'Pendiente'){
				$estado = $numero[1];
				$this->terman_model->cambiarEstado($codigo,$estado);
			}else{
				$estado = $this->terman_model->verEstado($codigo);
				$subtest = $this->terman_model->datosST($estado);
				$datosPregunta = $this->terman_model->obtenerPregunta($codigo,$estado);
				/* $aux = array_search($estado, $numero);
				$aux = $aux+1;
				print_r($aux);
				$estado = $numero[$aux];
				print_r($estado); */
			}
			$data = array(
				'nombre' => $a->nombre,
				'codigo' => $a->codigo,
				'serie' => $subtest->serie,
				'instruccion' => $subtest->instruccion,
				'ejemplo' => $subtest->ejemplo,
				'reactivo' => $datosPregunta[0]->reactivo,
				'datos' => $datosPregunta,
				'showInstructions' => $showInstructions,
				'duracion_en_segundos' => $subtest->tiempo,
				'fecha_fin_sesion' => date($a->finSesion),
				'acabo_tiempo' => $a->acabo
			);
			$this->load->view('layout/header');
			$this->load->view('terman/test_terman',$data);
			$this->load->view('layout/footer');
		}

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
		

    }
?>