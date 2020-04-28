<?php 
class Testalia extends CI_Controller{
		
	public function __construct(){
        parent::__construct();
		$this->load->helper(array('getmenu',));
	}

	public function index(){
		$data['menu'] = main_menu();
		$this->load->view('inicio',$data);
	}
}
?>