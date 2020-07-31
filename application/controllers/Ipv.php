<?php
	if (!defined('BASEPATH'))  exit('No direct script access allowed');

	class Ipv extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->model('ipv_model');
		}

		public function index(){
			$data = array('mensaje' => '');
			$this->load->view('layout/header');
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
					$this->load->view('layout/header');
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
						$this->load->view('layout/header');
						$this->load->view('ipv/validar',$data);
						$this->load->view('layout/footer');
					}else{
						$a = $this->ipv_model->obtenerDatos($codigo);
						$data = array(
							'nombre' => $a->nombre,
							'codigo' => $a->codigo
						);
						$this->load->view('layout/header');
						$this->load->view('ipv/index',$data);
						$this->load->view('layout/footer');
					}
				}else{
					$data = array('mensaje' => '<div class="row justify-content-center">'.
													'<div class="alert alert-warning col-3 ">'.
														'La código no pertece a esta encuesta'.
													'</div>'.
												'</div>');
					$this->load->view('layout/header');
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
				$this->load->view('layout/header');
				$this->load->view('ipv/test_ipv',$data);
				$this->load->view('layout/footer');
			}else{
				$this->ipv_model->estadoFecha($idAplicacion);
				$datos = $this->ipv_model->obtenerDatos($codigo);
				$data = array(
					'nombre' => $datos->nombre,
					'codigo' => $datos->codigo
				);
				$this->load->view('layout/header');
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
		public function resultados($codigo){
			for($i=1; $i<=87; $i++){
				$respuestas = $this->ipv_model->resultados($codigo,$i);
				foreach ($respuestas as $row){
					$A[$i] = $row->A;
					$B[$i] = $row->B;
					$C[$i] = $row->C;
				}
			}
			$I = $B[1]+$B[2]+$C[19]+$B[20]+$A[37]+$C[38]+$B[55]+$A[56]+$C[73]+$A[74]+$C[75];
			$II = $B[3]+$B[4]+$C[21]+$C[22]+$A[39]+$A[40]+$A[57]+$C[58]+$B[59]+$C[76]+$B[77];
			$III = $A[5]+$C[6]+$A[7]+$B[23]+$C[24]+$C[25]+$A[41]+$A[42]+$B[43]+$A[60]+$B[78];
			$IV = $B[8]+$B[26]+$A[44]+$B[61]+$A[62]+$B[79]+$C[80]+$C[81];
			$V = $A[9]+$B[10]+$B[11]+$A[27]+$C[28]+$C[29]+$B[45]+$B[46]+$B[63]+$A[64]+$C[82];
			$VI = $C[12]+$B[13]+$B[30]+$C[31]+$C[47]+$A[48]+$A[49]+$C[65]+$A[66]+$B[83]+$A[84];
			$VII = $A[14]+$C[32]+$C[50]+$B[67]+$A[68]+$C[85]+$A[86]+$A[87];
			$VIII = 8-($A[15]+$B[33]+$C[34]+$B[51]+$A[52]+$B[69]+$C[70]+$B[71]);
			$IX = $C[16]+$B[17]+$C[18]+$A[35]+$C[36]+$B[53]+$A[54]+$A[72];
			$DGV = $B[1]+$B[2]+$B[3]+$B[4]+$A[5]+$C[6]+$A[7]+$A[8]+$C[8]+$A[9]+$B[10]+$B[11]+$C[12]+$B[13]+$B[14]+$A[15]+$C[16]+$B[17]+$C[18];
			$R = $I + $II + $III + $IV;
			$A = $V + $VI + $VII + $VIII;

			$PD[] = array("enfoque" => "DGV","valor" => $DGV);
			$PD[] = array("enfoque" => "R","valor" => $R);
			$PD[] = array("enfoque" => "A","valor" => $A);
			$PD[] = array("enfoque" => "I","valor" => $I);
			$PD[] = array("enfoque" => "II","valor" => $II);
			$PD[] = array("enfoque" => "III","valor" => $III);
			$PD[] = array("enfoque" => "IV","valor" => $IV);
			$PD[] = array("enfoque" => "V","valor" => $V);
			$PD[] = array("enfoque" => "VI","valor" => $VI);
			$PD[] = array("enfoque" => "VII","valor" => $VII);
			$PD[] = array("enfoque" => "VIII","valor" => $VIII);
			$PD[] = array("enfoque" => "IX","valor" => $IX);
			for($i = 0; $i < sizeof($PD); $i++){
				$PT[] = self::convertir($PD[$i]['valor'],$PD[$i]['enfoque']);
			}
			for($i = 0; $i < sizeof($PT); $i++){
				$etiqueta[] = self::verEtiqueta($PT[$i]);
				$consulta[] = $this->ipv_model->interpreta($PD[$i]['enfoque'],$etiqueta[$i]);				
				$resultado[] = array(
					"interpretacion" => $consulta[$i]->interpretacion,
					"enfoque" => $PD[$i]['enfoque'],
					"PD" => $PD[$i]['valor'],
					"PT" => $PT[$i],
					"Escala" => $consulta[$i]->escala
				);
			}
			$datos = $this->ipv_model->obtenerDatos($codigo);	
			$data = array(
				'nombre' => $datos->nombre,
				'resultado' => $resultado,
				'consulta' => $consulta
			);
			if ($this->session->userdata('is_logged')) {
				$this->load->view('layout/header');
				$this->load->view('ipv/resultados',$data);
				$this->load->view('layout/footer');
			}else{
				redirect(base_url('login'));
			}
		}
		public function convertir($x,$y){
			switch ($y) {
				case "I":
					if($x >= 0 && $x <= 1){ return 1; }
					if($x == 2){ return 2; }
					if($x == 3){ return 3; }
					if($x == 4){ return 4; }
					if($x == 5){ return 6; }
					if($x == 6){ return 7; }
					if($x == 7){ return 8; }
					if($x == 8){ return 9; }
					if($x >= 9 && $x <= 11){ return 10; }
				break;
				case "II":
					if($x >= 0 && $x <= 1){ return 1; }
					if($x == 2){ return 2; }
					if($x == 3){ return 3; }
					if($x == 4){ return 4; }
					if($x == 5){ return 6; }
					if($x == 6){ return 7; }
					if($x == 7){ return 8; }
					if($x == 8){ return 9; }
					if($x >= 9 && $x <= 11){ return 10; }
				break;
				case "III":
					if($x >= 0 && $x <= 1){ return 1; }
					if($x == 2){ return 2; }
					if($x == 3){ return 3; }
					if($x == 4){ return 4; }
					if($x == 5){ return 5; }
					if($x == 6){ return 6; }
					if($x == 7){ return 8; }
					if($x == 8){ return 9; }
					if($x >= 9 && $x <= 11){ return 10; }
				break;
				case "IV":
					if($x >= 0 && $x <= 3){ return 1; }
					if($x == 4){ return 2; }
					if($x == 5){ return 4; }
					if($x == 6){ return 5; }
					if($x == 7){ return 7; }
					if($x == 8){ return 9; }
					if($x >= 9 && $x <= 11){ return 10; }
				break;
				case "V":
					if($x >= 0 && $x <= 1){ return 1; }
					if($x == 2){ return 2; }
					if($x == 3){ return 3; }
					if($x == 4){ return 4; }
					if($x == 5){ return 5; }
					if($x == 6){ return 7; }
					if($x == 7){ return 8; }
					if($x == 8){ return 9; }
					if($x >= 9 && $x <= 11){ return 10; }
				break;
				case "VI":
					if($x == 0){ return 1; }
					if($x == 1){ return 2; }
					if($x == 2){ return 3; }
					if($x == 3){ return 4; }
					if($x == 4){ return 6; }
					if($x == 5){ return 7; }
					if($x == 6){ return 8; }
					if($x >= 7 && $x <= 11){ return 10; }
				break;
				case "VII":
					if($x == 0){ return 1; }
					if($x == 1){ return 2; }
					if($x == 2){ return 4; }
					if($x == 3){ return 5; }
					if($x == 4){ return 7; }
					if($x == 5){ return 8; }
					if($x >= 6 && $x <= 8){ return 10; }
				break;
				case "VIII":
					if($x == 0){ return 2; }
					if($x == 1){ return 4; }
					if($x == 2){ return 6; }
					if($x == 3){ return 8; }
					if($x == 4){ return 9; }
					if($x >= 5 && $x <= 8){ return 10; }
				break;
				case "IX":
					if($x >= 0 && $x <= 1){ return 1; }
					if($x == 2){ return 2; }
					if($x == 3){ return 3; }
					if($x == 4){ return 4; }
					if($x == 5){ return 6; }
					if($x == 6){ return 7; }
					if($x == 7){ return 9; }
					if($x >= 8){ return 10; }
				break;
				case "DGV":
					if($x >= 0 && $x <= 5){ return 1; }
					if($x == 6){ return 2; }
					if($x >= 7 && $x <= 8){ return 3; }
					if($x == 9){ return 4; }
					if($x == 10){ return 5; }
					if($x == 11){ return 6; }
					if($x == 12){ return 7; }
					if($x >= 13 && $x <= 14){ return 8; }
					if($x == 15){ return 9; }
					if($x >= 16 && $x <= 21){ return 10; }
				break;
				case "R":
					if($x >= 0 && $x <= 14){ return 1; }
					if($x == 15){ return 2; }
					if($x >= 16 && $x <= 17){ return 3; }
					if($x >= 18 && $x <= 19){ return 4; }
					if($x == 20){ return 5; }
					if($x >= 21 && $x <= 22){ return 6; }
					if($x >= 23 && $x <= 24){ return 7; }
					if($x >= 25 && $x <= 26){ return 8; }
					if($x >= 27 && $x <= 28){ return 9; }
					if($x >= 29 && $x <= 41){ return 10; }
				break;
				case "A":
					if($x >= 0 && $x <= 7){ return 1; }
					if($x == 8){ return 2; }
					if($x >= 9 && $x <= 10){ return 3; }
					if($x >= 11 && $x <= 12){ return 4; }
					if($x == 13){ return 5; }
					if($x >= 14 && $x <= 15){ return 6; }
					if($x == 16){ return 7; }
					if($x >= 17 && $x <= 18){ return 8; }
					if($x >= 19 && $x <= 20){ return 9; }
					if($x >= 21 && $x <= 38){ return 10; }
				break;
			}
		}
		public function verEtiqueta($x){
			switch ($x) {
				case "1":
					return "Menor a 2";
				break;
				case "2":
					return "Entre 2.1 y 4";
				break;
				case "3":
					return "Entre 2.1 y 4";
				break;
				case "4":
					return "Entre 2.1 y 4";
				break;
				case "5":
					return "Entre 4.1 y 6";
				break;
				case "6":
					return "Entre 4.1 y 6";
				break;
				case "7":
					return "Entre 6.1 y 8";
				break;
				case "8":
					return "Entre 6.1 y 8";
				break;
				case "9":
					return "Mayor a 8";
				break;
				case "10":
					return "Mayor a 8";
				break;
			}
		}
    }
?>