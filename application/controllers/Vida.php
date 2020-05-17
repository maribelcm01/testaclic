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
			$progreso = $this->vida_model->verPregunta($codigo);

			$valor = $this->input->post('valor');
			$idAplicacion = $this->vida_model->verIdAplicacion($codigo);
			$idReactivo = $this->vida_model->verIdReactivo($codigo,$pregunta);
			
			$finalizado = $this->vida_model->verEstado($codigo);
			$idEncuesta = $this->vida_model->verIdEncuesta($codigo);

			$first_last = $this->vida_model->busca_menor_mayor($idEncuesta);
			$valor_reactivo = null;
			$control_siguiente = true; //maneja el boton de sig para no pintar la opción
			
			if(isset($_GET['back'])){
				if($_GET['back'] == $pregunta){ 
					redirect(base_url('vida/encuesta/'.$codigo));
				}
				$idReactivo = $this->vida_model->verIdReactivo($codigo,$_GET['back']);
				$s = $this->vida_model->verDatosBack($codigo,$idReactivo,$_GET['back'],$idEncuesta);
				$valor_reactivo = $s->valor;
				$control_siguiente=false;
				$pregunta = $s->indice;
				
				//print_r($s->reactivo);exit;
			}else{
				
				$s = $this->vida_model->verDatos($codigo,$idReactivo);
				//print_r($s);exit;
			}
			$data = array(
				'idReactivo' => $s->idReactivo,
				'reactivo' => $s->reactivo,
				'nombre' => $s->nombre,
				'codigo' => $s->codigo,
				'limite' => $limite,
				'pregunta' => $pregunta,
				'progreso' => $progreso,
				'valor_reactivo' => $valor_reactivo,
				'menor' => $first_last[0]['indice'],
				'mayor' => $first_last[1]['indice'],
				'control_siguiente' => $control_siguiente
			);

			//print_r($data);
			if($finalizado != "Finalizado"){
				if($pregunta <= $limite){
					$this->load->view('vida/header');
					$this->load->view('vida/test_vida',$data);
					$this->load->view('layout/footer');
				}
			}else{
				$this->load->view('vida/header');
				$this->load->view('vida/agradecimiento',$data);
				$this->load->view('layout/footer');
			}
		}
		public function encuestapost($codigo){
			$this->load->model('vida_model');
			$limite = $this->vida_model->verLimite($codigo);
			$pregunta = $this->vida_model->verPregunta($codigo);
			$valor = $this->input->post('valor');			
			$idAplicacion = $this->vida_model->verIdAplicacion($codigo);
			$idReactivo = $this->vida_model->verIdReactivo($codigo,$pregunta);
			$idEncuesta = $this->vida_model->verIdEncuesta($codigo);

			//proceso de guardar
			//evaluar si es la ultima pregunta
			//evaluar si es una actualización de pregunta
			if(isset($_GET['back'])){
				$idReactivo = $this->vida_model->verIdReactivo($codigo,$_GET['back']);
				$this->vida_model->registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor);
			}else{
				$this->vida_model->registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor);
			}
				
			
			$total_de_preguntas_reactivo= $this->vida_model->total_de_preguntas_reactivo($idEncuesta);
			
			if($total_de_preguntas_reactivo == $pregunta){
				//encuesta finalizada manda a gracias
				$this->vida_model->estadoFecha($idAplicacion);
				$this->load->view('vida/header');
				$this->load->view('vida/agradecimiento',$data);
				$this->load->view('layout/footer');
			}else{
				if(isset($_GET['back'])){//es una actualizacion
					$pregunta = $_GET['back'];
					redirect(base_url('vida/encuesta/'.$codigo));
				}else{
					$pregunta = $pregunta+1;
					$this->vida_model->ultimaRegistrada($pregunta,$idAplicacion,$idEcuesta);
					redirect(base_url('vida/encuesta/'.$codigo));
				}
				

			}
				
		}

	}
?>