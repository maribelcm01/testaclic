<?php 
class Testalia extends CI_Controller{
		
	public function __construct(){
        parent::__construct();
		$this->load->library(array('session',));
	}

	public function index(){
		if ($this->session->userdata('is_logged')) {
			$this->load->view('inicio');		
		}else{
			show_404();
		}
	}
}
?>