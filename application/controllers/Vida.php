<?php 
	class Vida extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('Vida_model');
		}

		public function index(){
			$data = array('mensaje' => '');
			$this->load->view('vida/header');
			$this->load->view('vida/validar',$data);
			$this->load->view('layout/footer');
		}

		public function validar(){
			$codigo = $this->input->post('codigo');
			$this->load->model('vida_model');
			
			$c = $this->vida_model->validarCodigo($codigo);
			//print_r($c);
			if($c == null){
				$data = array('mensaje' => 'El código ingresado es incorrecto');
				$this->load->view('vida/header');
				$this->load->view('vida/validar',$data);
				$this->load->view('layout/footer');
			}else{
				$estado = $this->vida_model->verEstado($codigo);
				//print_r($estado);	
				if($estado == 'Finalizado'){
					$data = array('mensaje' => 'La encuesta ya fue contestada');
					$this->load->view('vida/header');
					$this->load->view('vida/validar',$data);
					$this->load->view('layout/footer');
				}else{
					$a = $this->vida_model->obtenerDatos($codigo);
					$data = array(
						'nombre' => $a->nombre,
						'codigo' => $a->codigo
					);
					$this->load->view('vida/header');
					$this->load->view('vida/index',$data);
					$this->load->view('layout/footer');
				}
			}
		}

		public function encuesta($codigo){
			$this->load->model('vida_model');
			$limite = $this->vida_model->verLimite($codigo);
			$pregunta = $this->vida_model->verPregunta($codigo);
			$valor = $this->input->post('valor');			
			$idAplicacion = $this->vida_model->verIdAplicacion($codigo);
			$idReactivo = $this->vida_model->verIdReactivo($codigo,$pregunta);

			$s = $this->vida_model->verDatos($codigo,$idReactivo);
			$data = array(
				'idReactivo' => $s->idReactivo,
				'reactivo' => $s->reactivo,
				'nombre' => $s->nombre,
				'codigo' => $s->codigo,
				'limite' => $limite,
				'pregunta' => $pregunta
			);

			/*print_r(' ultima pregunta '.$limite);
			print_r(' idAplicacion'.$idAplicacion);
			print_r(' #pregunta '.$pregunta);
			print_r(' valor '.$valor);
			print_r(' idReactivo '.$idReactivo);*/

			if($pregunta != $limite){
				if($pregunta == 1){
					if($valor == null){
						$this->load->view('vida/header');
						$this->load->view('vida/test_vida',$data);
						$this->load->view('layout/footer');
					}else{
						$this->load->view('vida/header');
						$this->load->view('vida/test_vida',$data);
						$this->load->view('layout/footer');

						$this->vida_model->registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor);
						$pregunta = $pregunta+1;
						$this->vida_model->ultimaRegistrada($pregunta,$idAplicacion);
					}
				}else{
					if($valor == null){
						$this->load->view('vida/header');
						$this->load->view('vida/test_vida',$data);
						$this->load->view('layout/footer');
					}else{
						$this->load->view('vida/header');
						$this->load->view('vida/test_vida',$data);
						$this->load->view('layout/footer');

						$this->vida_model->registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor);
						if ($pregunta != $limite) {
							$pregunta = $pregunta+1;
							$this->vida_model->ultimaRegistrada($pregunta,$idAplicacion);
						}						
					}
				}
			}else{
				$this->vida_model->estadoFecha($idAplicacion);

				$a = $this->vida_model->obtenerDatos($codigo);
					$data = array(
						'nombre' => $a->nombre,
						'codigo' => $a->codigo
					);
				$this->load->view('vida/header');
				$this->load->view('vida/agradecimiento',$data);
				$this->load->view('layout/footer');
			}
		}
	}
?>