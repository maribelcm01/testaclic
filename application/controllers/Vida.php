<?php 
class Vida extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Vida_model');
	}

	public function index(){
		$this->load->view('vida/header');
		$this->load->view('vida/validar');
		$this->load->view('layout/footer');
	}

	public function validar(){
		$codigo = $this->input->post('codigo');
		$this->load->model('vida_model');
		$s = $this->vida_model->mostraridAplicacion($codigo);
		$data = array(
			
			'nombre' => $s->nombre,
			'codigo' => $s->codigo
		);
		
		$this->load->view('vida/header');
		$this->load->view('vida/index',$data);
		$this->load->view('layout/footer');
	}

	public function cuestionario($codigo){
		$this->load->model('vida_model');
		$s = $this->vida_model->reactivo($codigo);
		$data = array(
			'idReactivo' => $s->idReactivo,
			'reactivo' => $s->reactivo,
			'idAplicacion' => $s->idAplicacion,
			'nombre' => $s->nombre,
			'codigo' => $s->codigo
		);
		$this->load->view('vida/header');
		$this->load->view('vida/test_vida',$data);
	}




	public function mostrar($id = -1){
		$q = $this->Vida_model->reactivo($id);
		if(empty($q)){
			// Show an error page
			show_404();
		}
		//print_r($q);


		$codigo = 'Ds46sx1';
		$s = $this->Vida_model->mostraridAplicacionM($codigo);
		//print_r($s);

		$this->load->view('vida',array(
			'idReactivo' => $q[0]['idReactivo'],
			'reactivo'	=> $q[0]['reactivo'],
			'idAplicacion' => $s[0]['idAplicacion'])
			
		);
	}

	public function insertarAplicacionDetalle(){
		//echo $this->input->post("idAplicacion");
		//echo $this->input->post("idReactivo");
		//echo $this->input->post("valor");

		$idAplicacion = $this->input->post("idAplicacion");
		$idReactivo = $this->input->post("idReactivo");
		$valor = $this->input->post("valor");

		$limite = $this->Vida_model->mostrarLimite();

		if ($idReactivo <= $limite) {
			$this->Vida_model->registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor);
        	$this->mostrar($idReactivo+1);
		}else{
			
		}
	}
	

	//mahrko
	/*vista candidatos*/
	public function ver_candidatos($id){
		$data = array();
		$data['result'] = $this->Vida_model->candidatos_esta_encuesta($id);
		$data['encuesta'] = $this->Vida_model->encuesta($id);
		$this->load->view('layout/header');
		$this->load->view('vida/candidatos',$data);
		$this->load->view('layout/footer');
	}
	/*vista agregar candidatos*/
	public function agregar_candidato($id){
		$data['candidatos'] = $this->Vida_model->candidatos_para_encuesta($id);
		$data['encuesta'] = $id;
		$this->load->view('layout/header');
		$this->load->view('vida/candidatos/agregar',$data);
		$this->load->view('layout/footer');
	}
	/*agregar candidato a aplicaion*/
	public function registrar_candidato_aplicacion(){
		$candidato_id = $this->input->post('candidato');
        $encuesta_id = $this->input->post('encuesta');
        $this->Vida_model->registrar_candidato_en_aplicacion($candidato_id,$encuesta_id);
        redirect(base_url('/vida/ver_candidatos/').$encuesta_id);
	}
	/*mostrarle la pregunta en la que esta por contestar*/
	public function continuar_encuesta ($encuesta_id,$candidato_id,$num_pregunta){
		//validamos en que pregunta se quedo por default $num_pregunta trae 1
		//print_r($encuesta_id,$candidato_id,$num_pregunta);exit;
		$en_pregunta =   $this->Vida_model->estoy_en_pregunta($encuesta_id,$candidato_id);
		$estoy_en_pregunta = $en_pregunta[0]->num_pregunta_estado;
		
		if($num_pregunta != $estoy_en_pregunta) {
			redirect(base_url('/vida/continuar_encuesta/').$encuesta_id.'/'.$candidato_id.'/'.$estoy_en_pregunta);
		}else{
			$data = array();
			//$data['candidato'] = $this->Vida_model->candidato_info($candidato_id);
			$data['candidato'] = $this->Vida_model->candidato_para_responder($encuesta_id,$candidato_id);
			$data['reactivo'] = $this->Vida_model->pregunta_actual($encuesta_id,$estoy_en_pregunta);
			
			$this->load->view('layout/header');
			$this->load->view('vida/encuesta/index',$data);
			$this->load->view('layout/footer');

		}
		
	}
	/*evaluamos y guardamos la respuesta */
	public function guardarRespuestaApp($reactivo_indice,$reactivo_id,$candidato_id,$encuesta_id,$aplicacion_id){
		//aplicaciondetalle
		$reactivo_respuesta = $this->input->post('reactivo');
        $result = $this->Vida_model->guardarRespuestaApp($reactivo_indice,$reactivo_respuesta,$reactivo_id,$candidato_id,$encuesta_id,$aplicacion_id);
		//print_r($result[0]);exit;
		$finalizado  = $result[0];
		$nueva_pregunta = $result[1];
		if($finalizado == 1){
			redirect(base_url('/vida/ver_candidatos/').$encuesta_id);
		}else{
			redirect(base_url('/vida/continuar_encuesta/').$encuesta_id.'/'.$candidato_id.'/'.$nueva_pregunta);
		}
		//redirect('/vida/ver_candidatos/'.$id);
	}
}
?>