<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->helper(array('auth/login_rules'));
		$this->load->model('Auth');
	}

	public function index(){
		$this->load->view('login');
	}

	public function validate(){
		$this->form_validation->set_error_delimiters('','');
		$rules = getLoginRules();
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
			$errors	= array(
				'usuario' => form_error('usuario'),
				'contrasena' => form_error('contrasena'),
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
		}else{
			$usr = $this->input->post('usuario');
			$contr = $this->input->post('contrasena');

			if(!$res = $this->Auth->login($usr,$contr)){
				echo json_encode(array('msg' => "Verifique sus credenciales"));
				$this->output->set_status_header(401);
				exit;
			}
			$data = array(
				'idUsuario' => $res->idUsuario,
				'rango' => $res->rango,
				'estatus' => $res->estatus,
				'nombre' => $res->nombre,
				'is_logged' => TRUE,
			);
			$this->session->set_userdata($data);
			echo json_encode(array("url" => base_url('dashboard')));
		}
	}

	public function logout(){
		$vars = array('idUsuario','rango','estatus','nombre','is_logged');
		$this->session->unset_userdata($vars);
		$this->session->sess_destroy();

		redirect('login');
	}
}
?>