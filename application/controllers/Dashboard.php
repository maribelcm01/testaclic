<?php 
class Dashboard extends CI_Controller{
		
	public function __construct(){
        parent::__construct();
		$this->load->library(array('session',));
		$this->load->helper(array('getmenu'));
		$this->load->model('dashboard_model');
	}

	public function index(){
		$data['menu'] = main_menu();
		$aplicacion = $this->dashboard_model->aplicaciones();
		$persona = $this->dashboard_model->personas();
		$data['aplicacion'] = $aplicacion;
		$data['persona'] = $persona;
		if ($this->session->userdata('is_logged')) {
			$this->load->view('layout/header');	
        	$this->load->view('layout/navbar',$data);	
			$this->load->view('dashboard',$data);
        	$this->load->view('layout/footer');	
		}else{
			redirect(base_url('login'));
		}
	}
}
 ?>