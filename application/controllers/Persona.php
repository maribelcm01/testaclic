<?php 
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

    class Persona extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library(array('form_validation','session'));
            $this->load->helper(array('auth/login_rules'));
            $this->load->model('persona_model');
            $this->load->helper(array('getmenu'));
            $this->load->model('Auth');
        }
    
        public function index() {
            $data = array();
            $data['menu'] = main_menu();
            $data['persona'] = $this->persona_model->obtener_todos();
            if ($this->session->userdata('is_logged')) {
                $this->load->view('layout/header');
                $this->load->view('layout/navbar',$data);
                $this->load->view('persona/index', $data);
                $this->load->view('layout/footer');
            }else{
                redirect(base_url('login'));
            }      	
        }

        public function guardar($id=null){
            $data = array(); 
            if($id){
                $persona = $this->persona_model->obtener_por_id($id); 
                $data['idPersona'] = $persona->idPersona;
                $data['nombre'] = $persona->nombre;
                $data['telefono'] = $persona->telefono;
                $data['email'] = $persona->email;
            }else{
                $data['idPersona'] = null;
                $data['nombre'] = null;
                $data['telefono'] = null;
                $data['email'] = null;
            }

            $data['menu'] = main_menu();
            $this->load->view('layout/header');
            $this->load->view('layout/navbar',$data);
            $this->load->view('persona/guardar', $data);
            $this->load->view('layout/footer');
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
                    $this->persona_model->guardar($nombre, $telefono, $email, $id);
                    redirect('persona');
                }else{
                $data = array();
                $data['idPersona'] = $id;
                $data['nombre'] = $nombre;
                $data['telefono'] = $telefono;
                $data['email'] = $email;
                $this->load->view('layout/header');
                $this->load->view('persona/guardar', $data);
                $this->load->view('persona/footer');
                }          	
            }else{
                $this->guardar();
            } 
        }


        /* public function eliminar($id){
            $this->persona_model->eliminar($id);
            redirect('persona');
        } */
        
        public function ver($id){
            $data = array();
            $persona = $this->persona_model->obtener_por_id($id);
            $data['persona'] = $persona;

            $data['menu'] = main_menu();
            $this->load->view('layout/header');
            $this->load->view('layout/navbar',$data);
            $this->load->view('persona/ver', $data);
            $this->load->view('layout/footer');
        }
    }
 ?>