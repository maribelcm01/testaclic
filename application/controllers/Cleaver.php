<?php
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

    class Cleaver extends CI_Controller{
        public function __construct(){
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->model('cleaver_model');
        }

        public function index() {
            $data = array('mensaje' => '');
            $this->load->view('layout/header');
            $this->load->view('cleaver/validar',$data);
            $this->load->view('layout/footer');
        }

        public function validar(){
			$codigo = $this->input->post('codigo');
			$c = $this->cleaver_model->validarCodigo($codigo);
			//print_r($codigo);exit;
			if($c == null ){ 
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-danger col-3 ">'.
														'El código ingresado es incorrecto'.
													'</div>'.
												'</div>');
					$this->load->view('layout/header');
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
						$this->load->view('layout/header');
						$this->load->view('cleaver/validar',$data);
						$this->load->view('layout/footer');
					}else{
						$a = $this->cleaver_model->obtenerDatos($codigo);
						$data = array(
							'nombre' => $a->nombre,
							'codigo' => $a->codigo
						);
						$this->load->view('layout/header');
						$this->load->view('cleaver/index',$data);
						$this->load->view('layout/footer');
					}
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('layout/header');
					$this->load->view('cleaver/validar',$data);
					$this->load->view('layout/footer');
				}
			}
		}

		public function encuesta($codigo){
			$data = array();
			$pregunta = $this->cleaver_model->verPregunta($codigo);
			$progreso = $this->cleaver_model->verPregunta($codigo);
			$b = $pregunta*4;
			$a = $b-3;
			$limite = $this->cleaver_model->verLimite($codigo);
			$mayor = $limite/4;
			$idEncuesta = $this->cleaver_model->verIdEncuesta($codigo);
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			$first_last = $this->cleaver_model->busca_menor_mayor($idEncuesta);
			$control_siguiente = true;
			if($b > $limite){
				$this->cleaver_model->estadoFecha($idAplicacion);
				$datos = $this->cleaver_model->obtenerDatos($codigo);
				$data = array(
					'nombre' => $datos->nombre,
					'codigo' => $datos->codigo
				);
				$this->load->view('layout/header');
				$this->load->view('cleaver/agradecimiento',$data);
				$this->load->view('layout/footer');
			}else{
				$datos = $this->cleaver_model->obtenerDatos($codigo);
				if(isset($_GET['back'])){
					if($_GET['back'] == $pregunta){ 
						redirect(base_url('cleaver/encuesta/'.$codigo));
					}
					$pregunta = $_GET['back'];
					$b = $pregunta*4;
					$a = $b-3;
					$x = $this->cleaver_model->obtenerPalabrasBack($idAplicacion,$a,$b);
					
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
					$mas1 = 0;
					$mas2 = 0;
					$mas3 = 0;
					$mas4 = 0;
					$menos1 = 0;
					$menos2 = 0;
					$menos3 = 0;
					$menos4 = 0;			
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
					'progreso' => $progreso,
					'menor' => $first_last[0]['indice'],
					'mayor' => $mayor
				);
				
				$this->load->view('layout/header');
				$this->load->view('cleaver/test_cleaver',$data);
				$this->load->view('layout/footer');
			}
		}

		public function guardar_respuesta($codigo,$is_back){
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			$pregunta = $this->cleaver_model->verPregunta($codigo);
				
			if (!$this->input->is_ajax_request()) {
				redirect('404');
			} else {
				$input = $this->input->post();
				
				$idReactivo1 = $input['reactivo_1'];
				$res1 =$input['respuesta_1'];
				$idReactivo2 = $input['reactivo_2'];
				$res2 = $input['respuesta_2'];
				$idreactivoNulo1 = $input['nulo_0'];
				$idreactivoNulo2 = $input['nulo_1'];
				
				if($res1 == 1 && $res2 == 0){
					$this->cleaver_model->insertarRespuesta($idReactivo1,$idAplicacion,1,0);
					$this->cleaver_model->insertarRespuesta($idReactivo2,$idAplicacion,0,1);
				}else{
					$this->cleaver_model->insertarRespuesta($idReactivo1,$idAplicacion,0,1);
					$this->cleaver_model->insertarRespuesta($idReactivo2,$idAplicacion,1,0);
				}
				//nulos
				$this->cleaver_model->insertarRespuesta($idreactivoNulo1,$idAplicacion,0,0);
				$this->cleaver_model->insertarRespuesta($idreactivoNulo2,$idAplicacion,0,0);
				
				if($is_back == 'false'){
					$pregunta = $pregunta+1;
					$this->cleaver_model->actualizarPregunta($pregunta,$idAplicacion);
				}				
			}
			print_r($is_back);
		}

		public function resultados($codigo){
			$data = array();
			$idAplicacion = $this->cleaver_model->verIdAplicacion($codigo);
			$us = $this->cleaver_model->obtenerDatos($codigo);
			for($i=1; $i<=96; $i++){
				$respuestas = $this->cleaver_model->resultados($idAplicacion,$i);
				foreach ($respuestas as $row){
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

			$TD = $DM-$DL;
			$TI = $IM-$IL;
			$TS = $SM-$SL;
			$TC = $CM-$CL;

			$D1 = self::getAsignar($TD);			
			$I1 = self::getAsignar($TI);
			$S1 = self::getAsignar($TS);
			$C1 = self::getAsignar($TC);
			$D2 = self::getAsignar($DM);			
			$I2 = self::getAsignar($IM);
			$S2 = self::getAsignar($SM);
			$C2 = self::getAsignar($CM);
			$D3 = self::getAsignar($DL);			
			$I3 = self::getAsignar($IL);
			$S3 = self::getAsignar($SL);
			$C3 = self::getAsignar($CL);
			
			$total[] = array("nombre" => "D","valor" => $D1);
			$total[] = array("nombre" => "I","valor" => $I1);
			$total[] = array("nombre" => "S","valor" => $S1);
			$total[] = array("nombre" => "C","valor" => $C1);

			$totalO = self::ordenar($total);
			$datos = self::formulas($totalO);
			
			foreach($datos as $value){
				$resultados[] = $this->cleaver_model->interpreta($value);
			}
			$resultados_front = [];
			foreach($resultados as $key){
                $resultados_front[] = $key[0];
			}
			
			$data = array(
				'nombre' => $us->nombre,
				'idPersona' => $us->idPersona,
				'datos' => $datos,
				'resultados' => $resultados_front,
				'DTotal' => $D1,
				'ITotal' => $I1,
				'STotal' => $S1,
				'CTotal' => $C1,
				'DMas' => $D2,
				'IMas' => $I2,
				'SMas' => $S2,
				'CMas' => $C2,
				'DMenos' => $D3,
				'IMenos' => $I3,
				'SMenos' => $S3,
				'CMenos' => $C3
			);

			if ($this->session->userdata('is_logged')) {
				$this->load->view('layout/header');
				$this->load->view('cleaver/resultados',$data);
				$this->load->view('layout/footer');
			}else{
				redirect(base_url('login'));
			}
		}

		public function getAsignar($x){
			switch ($x) {
				case "10":
					return 100;
				break;
				case "9":
					return 95;
				break;
				case "8":
					return 90;
				break;
				case "7":
					return 85;
				break;
				case "6":
					return 80;
				break;
				case "5":
					return 75;
				break;
				case "4":
					return 70;
				break;
				case "3":
					return 65;
				break;
				case "2":
					return 60;
				break;
				case "1":
					return 55;
				break;
				case "0":
					return 50;
				break;
				case "-1":
					return 45;
				break;
				case "-2":
					return 40;
				break;
				case "-3":
					return 35;
				break;
				case "-4":
					return 30;
				break;
				case "-5":
					return 25;
				break;
				case "-6":
					return 20;
				break;
				case "-7":
					return 15;
				break;
				case "-8":
					return 10;
				break;
				case "-9":
					return 5;
				break;
				case "-10":
					return 0;
				break;
			}
		}
		
		public function ordenar($a){
			foreach ($a as $key => $row) {
				$aux[$key] = $row['valor'];
			}
			array_multisort($aux, SORT_DESC, $a);
			return $a;
		}

		public function formulas($b){
			$datos = array();
			if($b[0]["valor"] >= 75){array_push($datos,$b[0]["nombre"]."+");}
			if($b[1]["valor"] >= 75){array_push($datos,$b[1]["nombre"]."+");}
			if($b[2]["valor"] >= 75){array_push($datos,$b[2]["nombre"]."+");}
			if($b[3]["valor"] >= 75){array_push($datos,$b[3]["nombre"]."+");}

			if($b[0]["valor"] > $b[1]["valor"]){
				array_push($datos,$b[0]["nombre"]."/".$b[1]["nombre"]);
			}else{
				if($b[0]["nombre"] == "C" && $b[1]["nombre"] == "D"){array_push($datos,$b[0]["nombre"]."=".$b[1]["nombre"]);}
				if($b[0]["nombre"] == "D" && $b[1]["nombre"] == "C"){array_push($datos,$b[0]["nombre"]."=".$b[1]["nombre"]);}
			}

			if($b[0]["valor"] > $b[2]["valor"]){
				array_push($datos,$b[0]["nombre"]."/".$b[2]["nombre"]);
			}else{
				if($b[0]["nombre"] == "C" && $b[2]["nombre"] == "D"){array_push($datos,$b[0]["nombre"]."=".$b[2]["nombre"]);}
				if($b[0]["nombre"] == "D" && $b[2]["nombre"] == "C"){array_push($datos,$b[0]["nombre"]."=".$b[2]["nombre"]);}
			}

			if($b[0]["valor"] > $b[3]["valor"]){
				array_push($datos,$b[0]["nombre"]."/".$b[3]["nombre"]);
			}else{
				if($b[0]["nombre"] == "C" && $b[3]["nombre"] == "D"){array_push($datos,$b[0]["nombre"]."=".$b[3]["nombre"]);}
				if($b[0]["nombre"] == "D" && $b[3]["nombre"] == "C"){array_push($datos,$b[0]["nombre"]."=".$b[3]["nombre"]);}
			}

			if($b[1]["valor"] > $b[2]["valor"]){
				array_push($datos,$b[1]["nombre"]."/".$b[2]["nombre"]);
			}else{
				if($b[1]["nombre"] == "C" && $b[2]["nombre"] == "D"){array_push($datos,$b[1]["nombre"]."=".$b[2]["nombre"]);}
				if($b[1]["nombre"] == "D" && $b[2]["nombre"] == "C"){array_push($datos,$b[1]["nombre"]."=".$b[2]["nombre"]);}
			}

			if($b[1]["valor"] > $b[3]["valor"]){
				array_push($datos,$b[1]["nombre"]."/".$b[3]["nombre"]);
			}else{
				if($b[1]["nombre"] == "C" && $b[3]["nombre"] == "D"){array_push($datos,$b[1]["nombre"]."=".$b[3]["nombre"]);}
				if($b[1]["nombre"] == "D" && $b[3]["nombre"] == "C"){array_push($datos,$b[1]["nombre"]."=".$b[3]["nombre"]);}
			}

			if($b[2]["valor"] > $b[3]["valor"]){
				array_push($datos,$b[2]["nombre"]."/".$b[3]["nombre"]);
			}else{
				if($b[2]["nombre"] == "C" && $b[3]["nombre"] == "D"){array_push($datos,$b[2]["nombre"]."=".$b[3]["nombre"]);}
				if($b[2]["nombre"] == "D" && $b[3]["nombre"] == "C"){array_push($datos,$b[2]["nombre"]."=".$b[3]["nombre"]);}
			}

			if($b[0]["valor"] <= 25){array_push($datos,$b[0]["nombre"]."-");}
			if($b[1]["valor"] <= 25){array_push($datos,$b[1]["nombre"]."-");}
			if($b[2]["valor"] <= 25){array_push($datos,$b[2]["nombre"]."-");}
			if($b[3]["valor"] <= 25){array_push($datos,$b[3]["nombre"]."-");}

			return $datos;
		}
    }
?>