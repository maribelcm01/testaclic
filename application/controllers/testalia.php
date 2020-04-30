<?php 
class Testalia extends CI_Controller{
		
	public function __construct(){
        parent::__construct();
		$this->load->library(array('session',));
		$this->load->helper(array('getmenu'));
	}

	public function index(){
		$data['menu'] = main_menu();
		if ($this->session->userdata('is_logged')) {
			$this->load->view('inicio',$data);		
		}else{
			show_404();
		}
	}
}
?>