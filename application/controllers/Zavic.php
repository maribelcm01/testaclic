<?php
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

    class Zavic extends CI_Controller{
        public function __construct(){
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->model('zavic_model');
        }

        public function index() {
            $data = array('mensaje' => '');
            $this->load->view('layout/header');
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
					$this->load->view('layout/header');
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
						$this->load->view('layout/header');
						$this->load->view('zavic/validar',$data);
						$this->load->view('layout/footer');
					}else{
						$a = $this->zavic_model->obtenerDatos($codigo);
						$data = array(
							'nombre' => $a->nombre,
							'codigo' => $a->codigo
						);
						$this->load->view('layout/header');
						$this->load->view('zavic/index',$data);
						$this->load->view('layout/footer');
					}
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('layout/header');
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
			$progreso = $this->zavic_model->verPregunta($codigo);
			$pregunta = $this->zavic_model->verPregunta($codigo);
			$RptaA = null;
			$RptaB = null;
			$RptaC = null;
			$RptaD = null;
			if($pregunta <= $limite){
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
					'menor' => $first_last[0]['indice'],
					'mayor' => $first_last[1]['indice'],
					'idAplicacion' => $datos->idAplicacion,
					'idReactivo' => $r[0]['idReactivo'],
					'reactivo' => $r[0]['reactivo'],
					'pregunta' => $pregunta,
					'progreso' => $progreso,
					'respuestaA' => $r[0]['respuesta'],
					'respuestaB' => $r[1]['respuesta'],
					'respuestaC' => $r[2]['respuesta'],
					'respuestaD' => $r[3]['respuesta'],
					'RptaA' => $RptaA,
					'RptaB' => $RptaB,
					'RptaC' => $RptaC,
					'RptaD' => $RptaD
				);
				$this->load->view('layout/header');
				$this->load->view('zavic/test_zavic',$data);
				$this->load->view('layout/footer');
			}else{
				$this->zavic_model->estadoFecha($idAplicacion);
				$datos = $this->zavic_model->obtenerDatos($codigo);
				$data = array(
					'nombre' => $datos->nombre,
					'codigo' => $datos->codigo
				);
				$this->load->view('layout/header');
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

		public function resultados($codigo){
			for($i=1; $i<=20; $i++){
				$respuestas = $this->zavic_model->resultados($codigo,$i);
				foreach ($respuestas as $row){
					$A[$i] = $row->A;
					$B[$i] = $row->B;
					$C[$i] = $row->C;
					$D[$i] = $row->D;
				}
			}
			
			$VM = $A[3]+$D[4]+$A[6]+$B[8]+$B[9]+$B[12]+$A[13]+$D[15]+$D[17]+$A[19];
			$VL = $B[3]+$C[4]+$B[6]+$A[8]+$A[9]+$D[12]+$B[13]+$C[15]+$B[17]+$D[19];
			$VI = $C[3]+$A[4]+$D[6]+$C[8]+$D[9]+$A[12]+$C[13]+$B[15]+$A[17]+$B[19];
			$VC = $D[3]+$B[4]+$C[6]+$D[8]+$C[9]+$C[12]+$D[13]+$A[15]+$C[17]+$C[19];

			$IE = $C[1]+$C[2]+$D[5]+$B[7]+$A[10]+$A[11]+$A[14]+$A[16]+$B[18]+$A[20];
			$IP = $B[1]+$D[2]+$B[5]+$C[7]+$B[10]+$D[11]+$D[14]+$B[16]+$C[18]+$B[20];
			$IS = $A[1]+$B[2]+$A[5]+$A[7]+$D[10]+$B[11]+$C[14]+$D[16]+$D[18]+$D[20];
			$IR = $D[1]+$A[2]+$C[5]+$D[7]+$C[10]+$C[11]+$B[14]+$C[16]+$A[18]+$C[20];
			
			$us = $this->zavic_model->obtenerDatos($codigo);
			$data = array(
				'nombre' => $us->nombre,
				'idPersona' => $us->idPersona,
				'Moral' => $VM,
				'Legal' => $VL,
				'Indif' => $VI,
				'Corru' => $VC,
				'Econo' => $IE,
				'Polit' => $IP,
				'Socia' => $IS,
				'Relig' => $IR
			);
			if ($this->session->userdata('is_logged')) {
                $this->load->view('layout/header');
				$this->load->view('zavic/resultados',$data);
				$this->load->view('layout/footer');
            }else{
                redirect(base_url('login'));
            }   
		}
		
    }
?>