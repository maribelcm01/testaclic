<?php 
if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Candidato extends CI_Controller {
   	public function __construct() {
      	parent::__construct();
        $this->load->library('form_validation');

   	}
   
   	public function index() {
        $data = array();
      	$this->load->model('candidato_model');
      	$data['candidato'] = $this->candidato_model->obtener_todos();
      	      	
      	$this->load->view('candidato/header');
      	$this->load->view('candidato/index', $data);
      	$this->load->view('candidato/footer');
   	}

   	public function ver($id){
      	$data = array();
      	$this->load->model('candidato_model');
      	$candidato = $this->candidato_model->obtener_por_id($id);
      	$data['candidato'] = $candidato;

      	$this->load->view('candidato/header');
      	$this->load->view('candidato/ver', $data);
      	$this->load->view('candidato/footer');
   	}

   	public function guardar($id=null){
      	$data = array(); 
      	$this->load->model('candidato_model');
      	if($id){
         	  $candidato = $this->candidato_model->obtener_por_id($id); 
         	  $data['idCandidato'] = $candidato->idCandidato;
         	  $data['nombre'] = $candidato->nombre;
         	  $data['telefono'] = $candidato->telefono;
         	  $data['email'] = $candidato->email;
      	}else{
         	  $data['idCandidato'] = null;
         	  $data['nombre'] = null;
         	  $data['telefono'] = null;
         	  $data['email'] = null;
      	}
      	$this->load->view('candidato/header');
      	$this->load->view('candidato/guardar', $data);
      	$this->load->view('candidato/footer');
   	}


   	public function guardar_post($id=null){
        if($this->input->post()){
           	$nombre = $this->input->post('nombre');
          	$telefono = $this->input->post('telefono');
          	$email = $this->input->post('email');


            $config = array(
                array(
                    'field' => 'nombre',
                    'label' => 'Nombre de Usuario',
                    'rules' => 'required',
                ),
                array(
                    'field' => 'telefono',
                    'label' => 'Telefono',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'El %s es invalido.',
                    )
                ),
                array(
                    'field' => 'email',
                    'label' => 'Correo',
                    'rules' => 'required|valid_email',
                    'errors' => array(
                        'required' => 'El %s es invalido.',
                    )
                ),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE){
                $this->load->model('candidato_model');
                $this->candidato_model->guardar($nombre, $telefono, $email, $id);
                redirect('candidato');
            }else{
              $data = array();
              $data['idCandidato'] = $id;
              $data['nombre'] = $nombre;
              $data['telefono'] = $telefono;
              $data['email'] = $email;
              $this->load->view('candidato/header');
              $this->load->view('candidato/guardar', $data);
              $this->load->view('candidato/footer');
            }          	
      	}else{
         	  $this->guardar();
      	} 
   	}


   	public function eliminar($id){
      	$this->load->model('candidato_model');
      	$this->candidato_model->eliminar($id);
      	redirect('candidato');
   	}
}
 ?>