<?php
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

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
    }
?>