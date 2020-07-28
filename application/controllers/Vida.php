<?php
	if (!defined('BASEPATH'))  exit('No direct script access allowed');

	class Vida extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('vida_model');
		}

		public function index(){
			$data = array('mensaje' => '');
			$this->load->view('layout/header');
			$this->load->view('vida/validar',$data);
			$this->load->view('layout/footer');
		}

		public function validar(){
			$codigo = $this->input->post('codigo');
			$c = $this->vida_model->validarCodigo($codigo);
			//print_r($c);
			if($c == null){
				$data = array('mensaje' => '<div class="row justify-content-center">'.
												'<div class="alert alert-danger col-3 ">'.
													'El código ingresado es incorrecto'.
												'</div>'.
											'</div>');
				$this->load->view('layout/header');
				$this->load->view('vida/validar',$data);
				$this->load->view('layout/footer');
			}else{
				$idEncuesta = $this->vida_model->verIdEncuesta($codigo);
				$nombreEncuesta = $this->vida_model->verNombreEncuesta($idEncuesta);
				if($nombreEncuesta == 'Vida'){
					$estado = $this->vida_model->verEstado($codigo);
					//print_r($estado);	
					if($estado == 'Finalizado'){
						$data = array('mensaje' => '<div class="row justify-content-center">'.
														'<div class="alert alert-info col-3 ">'.
															'La encuesta ya fue contestada'.
														'</div>'.
													'</div>');
						$this->load->view('layout/header');
						$this->load->view('vida/validar',$data);
						$this->load->view('layout/footer');
					}else{
						$a = $this->vida_model->obtenerDatos($codigo);
						$data = array(
							'nombre' => $a->nombre,
							'codigo' => $a->codigo
						);
						$this->load->view('layout/header');
						$this->load->view('vida/index',$data);
						$this->load->view('layout/footer');
					}
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('layout/header');
					$this->load->view('vida/validar',$data);
					$this->load->view('layout/footer');
				}
			}
		}

		public function encuesta($codigo){
			$c = $this->vida_model->validarCodigo($codigo);
			if($c == null){
				redirect('errors/error_404');
			}else{
				$a = $this->vida_model->obtenerDatos($codigo);
				$limite = $this->vida_model->verLimite($codigo);
				$pregunta = $this->vida_model->verPregunta($codigo);
				//variable barra de progreso
				$progreso = $this->vida_model->verPregunta($codigo);
				$valor = $this->input->post('valor');
				$idAplicacion = $this->vida_model->verIdAplicacion($codigo);
				
				$estado = $this->vida_model->verEstado($codigo);
				$idEncuesta = $this->vida_model->verIdEncuesta($codigo);

				$first_last = $this->vida_model->busca_menor_mayor($idEncuesta);
				$valor_reactivo = null;
				$control_siguiente = true; //maneja el boton de sig para no pintar la opción
				
				if(isset($_GET['back'])){
					if($_GET['back'] == $pregunta){ 
						redirect(base_url('vida/encuesta/'.$codigo));
					}
					$pregunta = $_GET['back'];
					$s = $this->vida_model->verDatosBack($codigo,$pregunta);
					$valor_reactivo = $s->valor;
					$control_siguiente=false;
					$pregunta = $s->indice;
					
					//print_r($s->reactivo);exit;
				}else{
					$s = $this->vida_model->verDatos($codigo);
					//print_r($s);exit;
				}
				$data = array(
					'idReactivo' => $s->idReactivo,
					'reactivo' => $s->reactivo,
					'comentario' =>$s->comentario,
					'nombre' => $a->nombre,
					'codigo' => $s->codigo,
					'pregunta' => $pregunta,
					'progreso' => $progreso,
					'valor_reactivo' => $valor_reactivo,
					'menor' => $first_last[0]['indice'],
					'mayor' => $first_last[1]['indice'],
					'control_siguiente' => $control_siguiente
				);

				//print_r($data);
				if($estado != "Finalizado"){
					if($pregunta <= $limite){
						$this->load->view('layout/header');
						$this->load->view('vida/test_vida',$data);
						$this->load->view('layout/footer');
					}
				}else{					
					$this->load->view('layout/header');
					$this->load->view('vida/agradecimiento',$data);
					$this->load->view('layout/footer');
				}
			}
		}

		public function encuestapost($codigo){
			$c = $this->vida_model->validarCodigo($codigo);
			if($c == null){
				redirect('errors/error_404');
			}else{
				$valor = $this->input->post('valor');			
				$idReactivo = $this->input->post('idReactivo');
				$limite = $this->vida_model->verLimite($codigo);
				$pregunta = $this->vida_model->verPregunta($codigo);
				$idAplicacion = $this->vida_model->verIdAplicacion($codigo);
				$idEncuesta = $this->vida_model->verIdEncuesta($codigo);
				$nombreEncuesta = $this->vida_model->verNombreEncuesta($idEncuesta);
				
				//proceso de guardar
				//evaluar si es la ultima pregunta
				//evaluar si es una actualización de pregunta
				if(isset($_GET['back'])){
					$this->vida_model->insertarAplicacionVida($idReactivo,$idAplicacion,$valor);
				}else{
					$this->vida_model->insertarAplicacionVida($idReactivo,$idAplicacion,$valor);
				}
				if($limite == $pregunta){
					//encuesta finalizada manda a gracias
					//print_r($nombreEncuesta);
					if($nombreEncuesta == 'Vida'){
						$this->vida($idAplicacion);
					}
					$this->vida_model->estadoFecha($idAplicacion);
					$s = $this->vida_model->obtenerDatos($codigo);
					//print_r($s);exit;
					$data = array('nombre' => $s->nombre);
					$this->load->view('layout/header');
					$this->load->view('vida/agradecimiento',$data);
					$this->load->view('layout/footer');
				}else{
					if(isset($_GET['back'])){//es una actualizacion
						$pregunta = $_GET['back'];
						//avanza a la siguiente pregunta despues de contestar el back
						$siguientePregunta = $_GET['back']+1;
						redirect(base_url('vida/encuesta/'.$codigo.'?back='.$siguientePregunta));
					}else{
						$pregunta = $pregunta+1;
						$this->vida_model->ultimaRegistrada($pregunta,$idAplicacion);
						redirect(base_url('vida/encuesta/'.$codigo));
					}
				}
			}
		}

		public function vida($idAplicacion){
			$A1 = $this->vida_model->obtenerCluster(1,5,$idAplicacion);
			$B1 = $this->vida_model->obtenerCluster(31,35,$idAplicacion);
			$C1 = $this->vida_model->obtenerCluster(61,65,$idAplicacion);
			$D1 = $this->vida_model->obtenerCluster(91,95,$idAplicacion);
			$R1 = $A1 + $B1 +$C1 + $D1;
			
			$E1 = $this->vida_model->obtenerCluster(121,125,$idAplicacion);
			$F1 = $this->vida_model->obtenerCluster(151,155,$idAplicacion);
			$G1 = $this->vida_model->obtenerCluster(181,185,$idAplicacion);
			$H1 = $this->vida_model->obtenerCluster(211,215,$idAplicacion);
			$R2 = $E1 + $F1 +$G1 + $H1;

			$A2 = $this->vida_model->obtenerCluster(6,10,$idAplicacion);
			$B2 = $this->vida_model->obtenerCluster(36,40,$idAplicacion);
			$C2 = $this->vida_model->obtenerCluster(66,70,$idAplicacion);
			$D2 = $this->vida_model->obtenerCluster(96,100,$idAplicacion);
			$R3 = $A2 + $B2 +$C2 + $D2;

			$E2 = $this->vida_model->obtenerCluster(126,130,$idAplicacion);
			$F2 = $this->vida_model->obtenerCluster(156,160,$idAplicacion);
			$G2 = $this->vida_model->obtenerCluster(186,190,$idAplicacion);
			$H2 = $this->vida_model->obtenerCluster(216,220,$idAplicacion);
			$R4 = $E2 + $F2 +$G2 + $H2;

			$A3 = $this->vida_model->obtenerCluster(11,15,$idAplicacion);
			$B3 = $this->vida_model->obtenerCluster(41,45,$idAplicacion);
			$C3 = $this->vida_model->obtenerCluster(71,75,$idAplicacion);
			$D3 = $this->vida_model->obtenerCluster(101,105,$idAplicacion);
			$R5 = $A3 + $B3 +$C3 + $D3;

			$E3 = $this->vida_model->obtenerCluster(131,135,$idAplicacion);
			$F3 = $this->vida_model->obtenerCluster(161,165,$idAplicacion);
			$G3 = $this->vida_model->obtenerCluster(191,195,$idAplicacion);
			$H3 = $this->vida_model->obtenerCluster(221,225,$idAplicacion);
			$R6 = $E3 + $F3 +$G3 + $H3;

			$A4 = $this->vida_model->obtenerCluster(16,20,$idAplicacion);
			$B4 = $this->vida_model->obtenerCluster(46,50,$idAplicacion);
			$C4 = $this->vida_model->obtenerCluster(76,80,$idAplicacion);
			$D4 = $this->vida_model->obtenerCluster(106,110,$idAplicacion);
			$R7 = $A4 + $B4 +$C4 + $D4;

			$E4 = $this->vida_model->obtenerCluster(136,140,$idAplicacion);
			$F4 = $this->vida_model->obtenerCluster(166,170,$idAplicacion);
			$G4 = $this->vida_model->obtenerCluster(196,200,$idAplicacion);
			$H4 = $this->vida_model->obtenerCluster(226,230,$idAplicacion);
			$R8 = $E4 + $F4 +$G4 + $H4;

			$A5 = $this->vida_model->obtenerCluster(21,25,$idAplicacion);
			$B5 = $this->vida_model->obtenerCluster(51,55,$idAplicacion);
			$C5 = $this->vida_model->obtenerCluster(81,85,$idAplicacion);
			$D5 = $this->vida_model->obtenerCluster(111,115,$idAplicacion);
			$R9 = $A5 + $B5 +$C5 + $D5;

			$E5 = $this->vida_model->obtenerCluster(141,145,$idAplicacion);
			$F5 = $this->vida_model->obtenerCluster(171,175,$idAplicacion);
			$G5 = $this->vida_model->obtenerCluster(201,205,$idAplicacion);
			$H5 = $this->vida_model->obtenerCluster(231,235,$idAplicacion);
			$R10 = $E5 + $F5 +$G5 + $H5;

			$A6	= $this->vida_model->obtenerCluster(26,30,$idAplicacion);
			$B6 = $this->vida_model->obtenerCluster(56,60,$idAplicacion);
			$C6 = $this->vida_model->obtenerCluster(86,90,$idAplicacion);
			$D6 = $this->vida_model->obtenerCluster(116,120,$idAplicacion);
			$R11 = $A6 + $B6 +$C6 + $D6;

			$E6 = $this->vida_model->obtenerCluster(146,150,$idAplicacion);
			$F6 = $this->vida_model->obtenerCluster(176,180,$idAplicacion);
			$G6 = $this->vida_model->obtenerCluster(206,210,$idAplicacion);
			$H6 = $this->vida_model->obtenerCluster(236,240,$idAplicacion);
			$R12 = $E6 + $F6 +$G6 + $H6;

			$this->vida_model->insertarVida($idAplicacion,$R1,$R2,$R3,$R4,$R5,$R6,$R7,$R8,$R9,$R10,$R11,$R12);
			//print_r($R1.' '.$R2.' '.$R3.' '.$R4.' '.$R5.' '.$R6.' '.$R7.' '.$R8.' '.$R9.' '.$R10.' '.$R11.' '.$R12.' ');
		}
	}
?>