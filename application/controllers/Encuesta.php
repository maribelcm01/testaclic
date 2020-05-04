<?php 
if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Encuesta extends CI_Controller {
   	public function __construct() {
      	parent::__construct();
        $this->load->library(array('form_validation','session'));
        //$this->load->helper(array('auth/login_rules'));
        //$this->load->model('Auth');
        $this->load->helper(array('getmenu'));

   	}
   
   	public function index() {
        $data = array();
      	$this->load->model('encuesta_model');
      	$data['encuesta'] = $this->encuesta_model->obtener_todos();

        $data['menu'] = main_menu();
        /*if ($this->session->userdata('is_logged')) {
            $this->load->view('dashboard',$data);   
        }else{
            show_404();
        }*/
      	      	
      	$this->load->view('encuesta/header');
        $this->load->view('layout/navbar',$data);
      	$this->load->view('encuesta/index', $data);
      	$this->load->view('encuesta/footer');
   	}

   	/*public function ver($id){
      	$data = array();
      	$this->load->model('encuesta_model');
      	$encuesta = $this->encuesta_model->obtener_por_id($id);
      	$data['encuesta'] = $encuesta;

      	$this->load->view('encuesta/header');
      	$this->load->view('encuesta/ver', $data);
      	$this->load->view('encuesta/footer');
   	}*/

   	public function guardar($id=null){
      	$data = array(); 
      	$this->load->model('encuesta_model');
      	if($id){
         	  $encuesta = $this->encuesta_model->obtener_por_id($id); 
         	  $data['idEncuesta'] = $encuesta->idEncuesta;
         	  $data['nombre'] = $encuesta->nombre;
      	}else{
         	  $data['idEncuesta'] = null;
         	  $data['nombre'] = null;
      	}
      	$this->load->view('encuesta/header');
      	$this->load->view('encuesta/guardar', $data);
      	$this->load->view('encuesta/footer');
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
                $this->load->model('encuesta_model');
                $this->encuesta_model->guardar($nombre, $id);
                redirect('encuesta');
            }else{
              $data = array();
              $data['idEncuesta'] = $id;
              $data['nombre'] = $nombre;

              $this->load->view('encuesta/header');
              $this->load->view('encuesta/guardar', $data);
              $this->load->view('encuesta/footer');
            }          	
      	}else{
         	  $this->guardar();
      	} 
   	}


   	public function eliminar($id){
      	$this->load->model('encuesta_model');
      	$this->encuesta_model->eliminar($id);
      	redirect('encuesta');
   	}
}
 ?>