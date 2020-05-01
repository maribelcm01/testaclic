<?php 
/**
 * 
 */
class Vida extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Vida_model');
	}

	public function index(){
		$id = $this->Vida_model->verId();

		//print_r($id);

		$this->mostrar($id);
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
			'idAplicacion' => $s[0]['idAplicacion']),
			
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
}
?>