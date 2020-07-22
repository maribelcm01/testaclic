<?php
	if (!defined('BASEPATH'))  exit('No direct script access allowed');

	class Ipv extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('ipv_model');
		}

		public function index(){
			$data = array('mensaje' => '');
			$this->load->view('ipv/header');
			$this->load->view('ipv/validar',$data);
			$this->load->view('layout/footer');
        }

        public function validar(){
			$codigo = $this->input->post('codigo');
			$c = $this->ipv_model->validarCodigo($codigo);
			//print_r($codigo);exit;
			if($c == null){ 
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-danger col-3 ">'.
														'El código ingresado es incorrecto'.
													'</div>'.
												'</div>');
					$this->load->view('ipv/header');
					$this->load->view('ipv/validar',$data);
					$this->load->view('layout/footer');
			}else{
				$idEncuesta = $this->ipv_model->verIdEncuesta($codigo);
				$nombreEncuesta = $this->ipv_model->verNombreEncuesta($idEncuesta);
				if($nombreEncuesta == 'IPV'){
					$estado = $this->ipv_model->verEstado($codigo);
					//print_r($estado);	
					if($estado == 'Finalizado'){
						$data = array('mensaje' => '<div class="row justify-content-center">'.
														'<div class="alert alert-info col-3 ">'.
															'La encuesta ya fue contestada'.
														'</div>'.
													'</div>');
						$this->load->view('ipv/header');
						$this->load->view('ipv/validar',$data);
						$this->load->view('layout/footer');
					}else{
						$a = $this->ipv_model->obtenerDatos($codigo);
						$data = array(
							'nombre' => $a->nombre,
							'codigo' => $a->codigo
						);
						$this->load->view('ipv/header');
						$this->load->view('ipv/index',$data);
						$this->load->view('layout/footer');
					}
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('ipv/header');
					$this->load->view('ipv/validar',$data);
					$this->load->view('layout/footer');
				}
			}
        }
        
        public function encuesta($codigo){
            $a = $this->ipv_model->obtenerDatos($codigo);
            $limite = $this->ipv_model->verLimite($codigo);
			$pregunta = $this->ipv_model->verPregunta($codigo);
			$idEncuesta = $this->ipv_model->verIdEncuesta($codigo);
			$first_last = $this->ipv_model->busca_menor_mayor($idEncuesta);
			$progreso = $this->ipv_model->verPregunta($codigo);
			$idAplicacion = $this->ipv_model->verIdAplicacion($codigo);
			$control_siguiente = true;
			$opc = null;
			if($pregunta <= $limite){
				if(isset($_GET['back'])){
					if($_GET['back'] == $pregunta){ 
						redirect(base_url('ipv/encuesta/'.$codigo));
					}
					$pregunta = $_GET['back'];
					$datosPregunta = $this->ipv_model->obtenerPreguntaBack($codigo,$pregunta);
					if($datosPregunta[0]->A==1){$opc = 'A';}
					if($datosPregunta[0]->B==1){$opc = 'B';}
					if($datosPregunta[0]->C==1){$opc = 'C';}
					$control_siguiente=false;
				}else{
					$datosPregunta = $this->ipv_model->obtenerPregunta($codigo);
				}      
				$data = array(
					'nombre' => $a->nombre,
					'codigo' => $a->codigo,
					'idReactivo' => $datosPregunta[0]->idReactivo,
					'reactivo' => $datosPregunta[0]->reactivo,
					'datos' => $datosPregunta,
					'opc' => $opc,
					'pregunta' => $pregunta,
					'progreso' => $progreso,
					'menor' => $first_last[0]['indice'],
					'mayor' => $first_last[1]['indice'],
					'control_siguiente' => $control_siguiente
				);
				$this->load->view('ipv/header');
				$this->load->view('ipv/test_ipv',$data);
				$this->load->view('layout/footer');
			}else{
				$this->ipv_model->estadoFecha($idAplicacion);
				$datos = $this->ipv_model->obtenerDatos($codigo);
				$data = array(
					'nombre' => $datos->nombre,
					'codigo' => $datos->codigo
				);
				$this->load->view('ipv/header');
				$this->load->view('ipv/agradecimiento',$data);
				$this->load->view('layout/footer');
			}
		}
		
		public function encuesta_post($codigo){
			$opcion = $this->input->post('opcion');
			$idReactivo = $this->input->post('idReactivo');
			$idAplicacion = $this->ipv_model->verIdAplicacion($codigo);
			$limite = $this->ipv_model->verLimite($codigo);
			$pregunta = $this->ipv_model->verPregunta($codigo);
			
			if($opcion == 'A'){ $this->ipv_model->insertarAplicacionIpv($idReactivo,$idAplicacion,1,0,0); }
			if($opcion == 'B'){ $this->ipv_model->insertarAplicacionIpv($idReactivo,$idAplicacion,0,1,0); }
			if($opcion == 'C'){ $this->ipv_model->insertarAplicacionIpv($idReactivo,$idAplicacion,0,0,1); }
			
			if(isset($_GET['back'])){
				$pregunta = $_GET['back'];
				//avanza a la siguiente pregunta despues de contestar el back
				$siguientePregunta = $_GET['back']+1;
				redirect(base_url('ipv/encuesta/'.$codigo.'?back='.$siguientePregunta));
			}else{
				$pregunta = $pregunta+1;
				$this->ipv_model->ultimaRegistrada($pregunta,$idAplicacion);
				redirect(base_url('ipv/encuesta/'.$codigo));
			}
		}
    }
?>