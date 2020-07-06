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
			$limite = $this->zavic_model->verLimite($codigo);
			$idEncuesta = $this->zavic_model->verIdEncuesta($codigo);
			$idAplicacion = $this->zavic_model->verIdAplicacion($codigo);
			$first_last = $this->zavic_model->busca_menor_mayor($idEncuesta);
			$pregunta = $this->zavic_model->verPregunta($codigo);
			$RptaA = null;
			$RptaB = null;
			$RptaC = null;
			$RptaD = null;
			if($pregunta < $limite){
				if(isset($_GET['back'])){
					if($_GET['back'] == $pregunta){ 
						redirect(base_url('zavic/encuesta/'.$codigo));
					}
					$pregunta = $_GET['back'];
					$r = $this->zavic_model->obtenerPreguntaBack($codigo,$pregunta);
					$RptaA = $r[0]['A'];
					$RptaB = $r[1]['B'];
					$RptaC = $r[2]['C'];
					$RptaD = $r[3]['D'];
				}else{
					$r = $this->zavic_model->obtenerPregunta($codigo);
				}
				$data = array(
					'codigo' => $codigo,
					'nombre' => $datos->nombre,
					'pregunta' => $pregunta,
					'menor' => $first_last[0]['indice'],
					'mayor' => $first_last[1]['indice'],
					'idAplicacion' => $datos->idAplicacion,
					'idReactivo' => $r[0]['idReactivo'],
					'reactivo' => $r[0]['reactivo'],
					'pregunta' => $pregunta,
					'respuestaA' => $r[0]['respuesta'],
					'respuestaB' => $r[1]['respuesta'],
					'respuestaC' => $r[2]['respuesta'],
					'respuestaD' => $r[3]['respuesta'],
					'RptaA' => $RptaA,
					'RptaB' => $RptaB,
					'RptaC' => $RptaC,
					'RptaD' => $RptaD
				);
				$this->load->view('zavic/header');
				$this->load->view('zavic/test_zavic',$data);
				$this->load->view('layout/footer');
			}else{
				$this->zavic_model->estadoFecha($idAplicacion);
				$datos = $this->zavic_model->obtenerDatos($codigo);
				$data = array(
					'nombre' => $datos->nombre,
					'codigo' => $datos->codigo
				);
				$this->load->view('zavic/header');
				$this->load->view('zavic/agradecimiento',$data);
				$this->load->view('layout/footer');
			}
		}

		public function guardar($codigo,$is_back){
			$pregunta = $this->zavic_model->verPregunta($codigo);
			$idReactivo = $this->input->post('idReactivo');
			$idAplicacion = $this->input->post('idAplicacion');
			$valores = $this->input->post('valores');
			$RA = $valores[0];
			$RB = $valores[1];
			$RC = $valores[2];
			$RD = $valores[3];
			$this->zavic_model->insertarRespuesta($idReactivo,$idAplicacion,$RA,$RB,$RC,$RD);

			if($is_back == 'false'){
				$pregunta = $pregunta+1;
				$this->zavic_model->actualizarPregunta($pregunta,$idAplicacion);
			}
			print_r($is_back);
		}
    }
?>