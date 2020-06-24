<?php 
	if (!defined('BASEPATH'))  exit('No direct script access allowed');

	class Encuesta extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->helper(array('auth/login_rules'));
			$this->load->helper(array('getmenu'));
			$this->load->model('encuesta_model');
			$this->load->model('Auth');
		}
	
		public function index() {
			$data = array();
			$data['menu'] = main_menu();			
			$data['encuesta'] = $this->encuesta_model->obtener_todos();			
			if ($this->session->userdata('is_logged')) {
				$this->load->view('layout/header');
				$this->load->view('layout/navbar',$data);
				$this->load->view('encuesta/index', $data);
				$this->load->view('layout/footer');    
			}else{
				redirect(base_url('login'));
			}
		}

		public function guardar($id=null){
			$data = array(); 
			
			if($id){
				$encuesta = $this->encuesta_model->obtener_por_id($id); 
				$data['idEncuesta'] = $encuesta->idEncuesta;
				$data['nombre'] = $encuesta->nombre;
			}else{
				$data['idEncuesta'] = null;
				$data['nombre'] = null;
			}
			$data['menu'] = main_menu();
			$this->load->view('layout/header');
			$this->load->view('layout/navbar',$data);
			$this->load->view('encuesta/guardar', $data);
			$this->load->view('layout/footer');
		}


		public function guardar_post($id=null){
			if($this->input->post()){
				$nombre = $this->input->post('nombre');
				
				$config = array(
					array(
						'field' => 'nombre',
						'label' => 'Nombre de Usuario',
						'rules' => 'required',
					),
				);

				$this->form_validation->set_rules($config);

				if ($this->form_validation->run() == TRUE){
					$this->encuesta_model->guardar($nombre, $id);
					redirect('encuesta');
				}else{
				$data = array();
				$data['idEncuesta'] = $id;
				$data['nombre'] = $nombre;

				$this->load->view('layout/header');
				$this->load->view('encuesta/guardar', $data);
				$this->load->view('encuesta/footer');
				}          	
			}else{
				$this->guardar();
			} 
		}

		public function cambiarEstado($idEncuesta){
			$estado = $this->encuesta_model->verEstado($idEncuesta);
			if($estado == 1){
				$estado = 0;
				//print_r($estado);
				$this->encuesta_model->cambiarEstado($estado,$idEncuesta);
			}else{
				$estado = 1;
				//print_r($estado);
				$this->encuesta_model->cambiarEstado($estado,$idEncuesta);
			}
			redirect(base_url("encuesta"));
		}
		
		/*public function ver($id){
			$data = array();
			$encuesta = $this->encuesta_model->obtener_por_id($id);
			$data['encuesta'] = $encuesta;

			$this->load->view('layout/header');
			$this->load->view('encuesta/ver', $data);
			$this->load->view('layout/footer');
		}*/

		/*public function eliminar($id){
			$this->encuesta_model->eliminar($id);
			redirect('encuesta');
		}*/
	}
 ?>