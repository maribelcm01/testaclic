<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->load->helper(array('getmenu'));
		$this->load->model('Users');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['menu'] = main_menu();
		$this->load->view('registro',$data);
	}
	public function create(){
		$nombre = $this->input->post('nombre');
		$correo = $this->input->post('correo');
		$contrasena = $this->input->post('contrasena');
		$contrasena_c = $this->input->post('contrasena_confirm');


		$config = array(
			array(
				'field' => 'nombre',
				'label' => 'Nombre de Usuario',
				'rules' => 'required',
			),
			array(
				'field' => 'correo',
				'label' => 'Correo',
				'rules' => 'required|valid_email',
				'errors' => array(
					'required' => 'EL correo %s es invalido.',
				)
			),
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			$data['menu'] = main_menu();
			$this->load->view('registro',$data);
		}else{
			$datos = array(
				'nombre' => $nombre,
				'correo' => $correo,
				'contrasena' => $contrasena,
			);
			
			$data['menu'] = main_menu();
			if (!$this->Users->create($datos)) {
				$data['msg'] = 'Ocurrio un error al ingresar los datos intente más tarde';
				$this->load->view('registro',$data);
			}
			$data['msg'] ='Registrado correctamente';
			$this->load->view('registro',$data);
		}

	}
}
?>