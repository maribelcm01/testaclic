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
				$idEncuesta = $this->cleaver_model->verIdEncuesta($codigo);
				$nombreEncuesta = $this->cleaver_model->verNombreEncuesta($idEncuesta);
				if($nombreEncuesta == 'Cleaver'){
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
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('cleaver/header');
					$this->load->view('cleaver/validar',$data);
					$this->load->view('layout/footer');
				}
			}
		}

		public function encuesta($codigo){
			$data = array();
			$pregunta = $this->cleaver_model->verPregunta($codigo);
			$b = $pregunta*4;
			$a = $b-3;
			$limite = $this->cleaver_model->verLimite($codigo);
			$idEncuesta = $this->cleaver_model->verIdEncuesta($codigo);
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			$first_last = $this->cleaver_model->busca_menor_mayor($idEncuesta);
			//$valor_reactivo = null;
			$control_siguiente = true;

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
				$datos = $this->cleaver_model->obtenerDatos($codigo);
				if(isset($_GET['back'])){
					if($_GET['back'] == $pregunta){ 
						redirect(base_url('vida/encuesta/'.$codigo));
					}
					$pregunta = $_GET['back'];
					$b = $pregunta*4;
					$a = $b-3;
					$x = $this->cleaver_model->obtenerPalabrasBack($idEncuesta,$a,$b);
					/* print_r($x); */
					$mas1 = $x[0]['mas'];
					$mas2 = $x[1]['mas'];
					$mas3 = $x[2]['mas'];
					$mas4 = $x[3]['mas'];
					$menos1 = $x[0]['menos'];
					$menos2 = $x[1]['menos'];
					$menos3 = $x[2]['menos'];
					$menos4 = $x[3]['menos'];
				}else{
					$x = $this->cleaver_model->obtenerPalabras($idEncuesta,$a,$b);
					$mas1 = 0; $mas2 = 0; $mas3 = 0; $mas4 = 0;
					$menos1 = 0; $menos2 = 0; $menos3 = 0; $menos4 = 0;			
				}

				$data = array(
					'nombre' => $datos->nombre,
					'palabra1' => $x[0]['reactivo'],
					'palabra2' => $x[1]['reactivo'],
					'palabra3' => $x[2]['reactivo'],
					'palabra4' => $x[3]['reactivo'],
					'idReactivo1' => $x[0]['idReactivo'],
					'idReactivo2' => $x[1]['idReactivo'],
					'idReactivo3' => $x[2]['idReactivo'],
					'idReactivo4' => $x[3]['idReactivo'],
					'mas1' => $mas1,
					'mas2' => $mas2,
					'mas3' => $mas3,
					'mas4' => $mas4,
					'menos1' => $menos1,
					'menos2' => $menos2,
					'menos3' => $menos3,
					'menos4' => $menos4,
					'codigo' => $codigo,
					'pregunta' => $pregunta,
					'menor' => $first_last[0]['indice'],
					'mayor' => $first_last[1]['indice']
				);
				
				$this->load->view('cleaver/header');
				$this->load->view('cleaver/test_cleaver',$data);
				$this->load->view('layout/footer');
			}
		}

		public function guardar_respuesta($codigo){
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			$pregunta = $this->cleaver_model->verPregunta($codigo);
				
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
				
				/* if(isset($_GET['back'])){
					$pregunta = $_GET['back']+1;
				}else{ */
					$pregunta = $pregunta+1;
					$this->cleaver_model->actualizarPregunta($pregunta,$idAplicacion);
				//}
			}

			print_r($response);
			if($response == true){
				$this->output->set_status_header(200); //guardo correctamente
			}else{
				$this->output->set_status_header(400); // algo ocurrio
			}
		}

		public function resultados($codigo){
			$data = array();
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			for($i=1; $i<=96; $i++){
				$respuestas = $this->cleaver_model->resultados($idAplicacion,$i);
				foreach ($respuestas as $row){
					//$indice[$i] = $row->indice;
					$mas[$i] = $row->mas;
					$menos[$i] = $row->menos;
				}
			}
			
			$DM = $mas[5]+$mas[11]+$mas[14]+$mas[18]+$mas[32]+$mas[40]+$mas[41]+$mas[48]+$mas[51]+$mas[54]+$mas[57]+$mas[62]+$mas[67]+$mas[72]+$mas[73]+$mas[79]+$mas[84]+$mas[87]+$mas[90]+$mas[93];
			$IM = $mas[1]+$mas[6] +$mas[12]+$mas[15]+$mas[20]+$mas[28]+$mas[29]+$mas[45]+$mas[52]+$mas[55]+$mas[58]+$mas[64]+$mas[65]+$mas[75]+$mas[80]+$mas[81]+$mas[88]+$mas[94];
			$SM = $mas[2]+$mas[7] +$mas[16]+$mas[19]+$mas[21]+$mas[27]+$mas[33]+$mas[38]+$mas[43]+$mas[46]+$mas[49]+$mas[56]+$mas[66]+$mas[70]+$mas[76]+$mas[77]+$mas[82]+$mas[92]+$mas[95];
			$CM = $mas[3]+$mas[10]+$mas[13]+$mas[23]+$mas[26]+$mas[34]+$mas[37]+$mas[53]+$mas[61]+$mas[68]+$mas[71]+$mas[74]+$mas[86]+$mas[89]+$mas[96];

			$DL = $menos[4]+$menos[11]+$menos[18]+$menos[24]+$menos[25]+$menos[32]+$menos[35]+$menos[40]+$menos[41]+$menos[48]+$menos[51]+$menos[54]+$menos[62]+$menos[67]+$menos[72]+$menos[73]+$menos[79]+$menos[84]+$menos[87]+$menos[90]+$menos[93];
			$IL = $menos[6]+$menos[12]+$menos[15]+$menos[20]+$menos[28]+$menos[36]+$menos[39]+$menos[42]+$menos[52]+$menos[55]+$menos[64]+$menos[65]+$menos[70]+$menos[75]+$menos[80]+$menos[81]+$menos[88]+$menos[91]+$menos[94];
			$SL = $menos[2]+$menos[7] +$menos[9]+ $menos[27]+$menos[30]+$menos[33]+$menos[38]+$menos[43]+$menos[56]+$menos[59]+$menos[63]+$menos[66]+$menos[69]+$menos[76]+$menos[77]+$menos[82]+$menos[85]+$menos[92]+$menos[95];
			$CL = $menos[3]+$menos[8] +$menos[10]+$menos[13]+$menos[17]+$menos[23]+$menos[31]+$menos[34]+$menos[44]+$menos[47]+$menos[50]+$menos[60]+$menos[71]+$menos[78]+$menos[83]+$menos[96];

			/* print_r($DM);
			print_r($DL);
			print_r($IM);
			print_r($IL);
			print_r($SM);
			print_r($SL);
			print_r($CM);
			print_r($CL); */

			$TD = $DM-$DL;
			$TI = $IM-$IL;
			$TS = $SM-$SL;
			$TC = $CM-$CL;

			/* print_r($TD);
			print_r($TI);
			print_r($TS);
			print_r($TC); */

			$data = array(
				'DM' => $DM,
				'IM' => $IM,
				'SM' => $SM,
				'CM' => $CM,
				'DL' => $DL,
				'IL' => $IL,
				'SL' => $SL,
				'CL' => $CL,
				'totalD' => $TD,
				'totalI' => $TI,
				'totalS' => $TS,
				'totalC' => $TC
			);

			$this->load->view('cleaver/header');
			$this->load->view('cleaver/resultados',$data);
			$this->load->view('layout/footer');
		}
    }
?>