<?php 
class Testalia extends CI_Controller{
		
	public function __construct(){
        parent::__construct();
		$this->load->library(array('session',));
		$this->load->helper(array('getmenu'));
	}

	public function index(){
		$data['menu'] = main_menu();
		$this->load->view('header');
		$this->load->view('index',$data);		
		$this->load->view('footer');
	}
}
?>