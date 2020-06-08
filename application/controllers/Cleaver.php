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
			
			//print_r($codigo);exit;
			if($c == null ){ 
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

		public function encuesta($codigo){
			$a = $_GET['a'];
			$b = $_GET['b'];
			$data = array();
			$limite = $this->cleaver_model->verLimite($codigo);
			$idEncuesta = $this->cleaver_model->verIdEncuesta($codigo);
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);

			if($b > $limite){
				$this->cleaver_model->estadoFecha($idAplicacion);
				$datos = $this->cleaver_model->obtenerDatos($codigo);
				$data = array(
					'nombre' => $datos->nombre,
					'codigo' => $datos->codigo
				);
				$this->load->view('cleaver/header');
				$this->load->view('cleaver/agradecimiento',$data);
				$this->load->view('layout/footer');
			}else{
				$x = $this->cleaver_model->obtenerPalabras($idEncuesta,$a,$b);			
				$data['palabra1'] = $x[0]['reactivo'];
				$data['palabra2'] = $x[1]['reactivo'];
				$data['palabra3'] = $x[2]['reactivo'];
				$data['palabra4'] = $x[3]['reactivo'];

				$data['idReactivo1'] = $x[0]['idReactivo'];
				$data['idReactivo2'] = $x[1]['idReactivo'];
				$data['idReactivo3'] = $x[2]['idReactivo'];
				$data['idReactivo4'] = $x[3]['idReactivo'];
				$data['codigo'] = $codigo;
				
				$this->load->view('cleaver/header');
				$this->load->view('cleaver/test_cleaver',$data);
				$this->load->view('layout/footer');
			}
		}

		public function guardar_respuesta($codigo){
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			
			
			if (!$this->input->is_ajax_request()) {
				redirect('404');
			} else {
				$input = $this->input->post();
				//numero de la pregunta ++
				/* echo $input['reactivo_1']."<br>";
				echo $input['respuesta_1']."<br>";
				echo $input['reactivo_2']."<br>";
				echo $input['respuesta_2']."<br>"; */
				
				$idReactivo1 = $input['reactivo_1'];
				$res1 =$input['respuesta_1'];
				$idReactivo2 = $input['reactivo_2'];
				$res2 = $input['respuesta_2'];

				$idreactivoNulo1 = $input['nulo_0'];
				$idreactivoNulo2 = $input['nulo_1'];

				if($res1 == 1 && $res2 == 0){
					$response = $this->cleaver_model->insertarRespuesta($idReactivo1,$idAplicacion,1,0);
					$response = $this->cleaver_model->insertarRespuesta($idReactivo2,$idAplicacion,0,1);
				}else{
					$response = $this->cleaver_model->insertarRespuesta($idReactivo1,$idAplicacion,0,1);
					$response = $this->cleaver_model->insertarRespuesta($idReactivo2,$idAplicacion,1,0);
				}
				//nulos
				$response = $this->cleaver_model->insertarRespuesta($idreactivoNulo1,$idAplicacion,0,0);
				$response = $this->cleaver_model->insertarRespuesta($idreactivoNulo2,$idAplicacion,0,0);

			}
			print_r($response);
			if($response == true){
				$this->output->set_status_header(200); //guardo correctamente
			}else{
				$this->output->set_status_header(400); // algo ocurrio
			}
		}

		public function resultados($codigo){
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			//for($i=1; $i<=5; $i++){
				$respuestas = $this->cleaver_model->resultados($idAplicacion,2);
				foreach ($respuestas as $row=>$res){
					$indice = $res->indice;
					$mas = $res->mas;
					$menos = $res->menos;
					//print_r($indice);
				}
				print_r($indice);
				print_r($mas);
				print_r($menos);
				print_r($res[1]);
				

				//$DM = $respuestas['mas'];
				//print_r($respuestas);
			//}
			//print_r($respuestas);
			$DM = 0;
			$IM = 0;
			$SM = 0;
			$CM = 0;
			$DL = 0;
			$IL = 0;
			$SL = 0;
			$CL = 0;

			$this->load->view('cleaver/header');
			$this->load->view('cleaver/resultados');
			$this->load->view('layout/footer');
		}
    }
?>