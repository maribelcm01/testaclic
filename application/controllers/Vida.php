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
		$data['reactivo'] = $this->Vida_model->reactivos();
		//$data['candidato'] = $this->Vida_model->get_candidato_by_code();
		$this->load->view('vida',$data);
	}
}
 ?>