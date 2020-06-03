<?php
     if (!defined('BASEPATH'))  exit('No direct script access allowed');

     class Cleaver extends CI_Controller{
        public function __construct(){
            parent::__construct();
			$this->load->model('cleaver_model');
        }

        public function index() {
            $data = array('mensaje' => '');
            $this->load->view('cleaver/header');
            $this->load->view('cleaver/validar',$data);
            $this->load->view('layout/footer');
        }

        public function validar(){
			$codigo = $this->input->post('codigo');
			$this->load->model('cleaver_model');
			
			$c = $this->cleaver_model->validarCodigo($codigo);
			$idEncuesta = $this->cleaver_model->verIdEncuesta($codigo);
			$nombreEncuesta = $this->cleaver_model->verNombreEncuesta($idEncuesta);
			//print_r($c);
			if($c == null || $nombreEncuesta != 'Cleaver'){
				$data = array('mensaje' => '<div class="row justify-content-center">'.
												'<div class="alert alert-danger col-3 ">'.
													'El código ingresado es incorrecto'.
												'</div>'.
											'</div>');
				$this->load->view('cleaver/header');
				$this->load->view('cleaver/validar',$data);
				$this->load->view('layout/footer');
			}else{
				$estado = $this->cleaver_model->verEstado($codigo);
				//print_r($estado);	
				if($estado == 'Finalizado'){
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-info col-3 ">'.
														'La encuesta ya fue contestada'.
													'</div>'.
												'</div>');
					$this->load->view('cleaver/header');
					$this->load->view('cleaver/validar',$data);
					$this->load->view('layout/footer');
				}else{
					$a = $this->cleaver_model->obtenerDatos($codigo);
					$data = array(
						'nombre' => $a->nombre,
						'codigo' => $a->codigo
					);
					$this->load->view('cleaver/header');
					$this->load->view('cleaver/index',$data);
					$this->load->view('layout/footer');
				}
			}
		}

		public function encuesta($codigo,$a,$b){
			$data = array();
			$idEncuesta = $this->cleaver_model->verIdEncuesta($codigo);
			$x = $this->cleaver_model->obtenerPalabras($idEncuesta,$a,$b);
			print_r($x);
			
			$data['palabra1'] = $x[0]['reactivo'];
			$data['palabra2'] = $x[1]['reactivo'];
			$data['palabra3'] = $x[2]['reactivo'];
			$data['palabra4'] = $x[3]['reactivo'];
			$data['codigo'] = $codigo;
			
			$this->load->view('cleaver/header');
			$this->load->view('cleaver/test_cleaver',$data);
			$this->load->view('layout/footer');
		}

		public function insertar($codigo){
			
		}
		
     }
?>