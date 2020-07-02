<?php
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

    class Zavic extends CI_Controller{
        public function __construct(){
            parent::__construct();
			$this->load->model('zavic_model');
        }

        public function index() {
            $data = array('mensaje' => '');
            $this->load->view('zavic/header');
            $this->load->view('zavic/validar',$data);
            $this->load->view('layout/footer');
        }

        public function validar(){
			$codigo = $this->input->post('codigo');
			$c = $this->zavic_model->validarCodigo($codigo);
			//print_r($codigo);exit;
			if($c == null){ 
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-danger col-3 ">'.
														'El código ingresado es incorrecto'.
													'</div>'.
												'</div>');
					$this->load->view('zavic/header');
					$this->load->view('zavic/validar',$data);
					$this->load->view('layout/footer');
			}else{
				$idEncuesta = $this->zavic_model->verIdEncuesta($codigo);
				$nombreEncuesta = $this->zavic_model->verNombreEncuesta($idEncuesta);
				if($nombreEncuesta == 'Zavic'){
					$estado = $this->zavic_model->verEstado($codigo);
					//print_r($estado);	
					if($estado == 'Finalizado'){
						$data = array('mensaje' => '<div class="row justify-content-center">'.
														'<div class="alert alert-info col-3 ">'.
															'La encuesta ya fue contestada'.
														'</div>'.
													'</div>');
						$this->load->view('zavic/header');
						$this->load->view('zavic/validar',$data);
						$this->load->view('layout/footer');
					}else{
						$a = $this->zavic_model->obtenerDatos($codigo);
						$data = array(
							'nombre' => $a->nombre,
							'codigo' => $a->codigo
						);
						$this->load->view('zavic/header');
						$this->load->view('zavic/index',$data);
						$this->load->view('layout/footer');
					}
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('zavic/header');
					$this->load->view('zavic/validar',$data);
					$this->load->view('layout/footer');
				}
			}
		}
		
        public function encuesta($codigo){
			$datos = $this->zavic_model->obtenerDatos($codigo);
			$r = $this->zavic_model->obtenerPregunta($codigo);
			
			$data = array(
				'nombre' => $datos->nombre,
				'reactivo' => $r[0]['reactivo'],
				'respuestaA' => $r[0]['respuesta'],
				'respuestaB' => $r[1]['respuesta'],
				'respuestaC' => $r[2]['respuesta'],
				'respuestaD' => $r[3]['respuesta']
			);
            $this->load->view('zavic/header');
            $this->load->view('zavic/test_zavic',$data);
            $this->load->view('layout/footer');
        }
    }
?>