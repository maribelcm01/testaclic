<?php
     if (!defined('BASEPATH'))  exit('No direct script access allowed');

     class Autodescripcion extends CI_Controller{
        public function __construct(){
            parent::__construct();
			$this->load->model('Vida_model');
        }

        public function index() {
            $data = array('mensaje' => '');
            $this->load->view('autodescripcion/header');
            $this->load->view('autodescripcion/validar',$data);
            $this->load->view('layout/footer');
        }

        public function validar(){
			$codigo = $this->input->post('codigo');
			$this->load->model('vida_model');
			
			$c = $this->vida_model->validarCodigo($codigo);
			$idEncuesta = $this->vida_model->verIdEncuesta($codigo);
			$nombreEncuesta = $this->vida_model->verNombreEncuesta($idEncuesta);
			//print_r($c);
			if($c == null || $nombreEncuesta != 'Autodescipción Personal'){
				$data = array('mensaje' => '<div class="row justify-content-center">'.
												'<div class="alert alert-danger col-3 ">'.
													'El código ingresado es incorrecto'.
												'</div>'.
											'</div>');
				$this->load->view('autodescripcion/header');
				$this->load->view('autodescripcion/validar',$data);
				$this->load->view('layout/footer');
			}else{
				$estado = $this->vida_model->verEstado($codigo);
				//print_r($estado);	
				if($estado == 'Finalizado'){
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-info col-3 ">'.
														'La encuesta ya fue contestada'.
													'</div>'.
												'</div>');
					$this->load->view('autodescripcion/header');
					$this->load->view('autodescripcion/validar',$data);
					$this->load->view('layout/footer');
				}else{
					$a = $this->vida_model->obtenerDatos($codigo);
					$data = array(
						'nombre' => $a->nombre,
						'codigo' => $a->codigo
					);
					$this->load->view('autodescripcion/header');
					$this->load->view('autodescripcion/index',$data);
					$this->load->view('layout/footer');
				}
			}
		}
     }
?>