<?php 
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

    class Aplicacion extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->library(array('form_validation','session'));
            $this->load->helper(array('auth/login_rules'));
            $this->load->model('aplicacion_model');
            $this->load->helper(array('getmenu'));
            $this->load->model('Auth');
        }

        public function index() {
            $data = array();
            $data['menu'] = main_menu();
            $data['aplicacion'] = $this->aplicacion_model->obtener_todos();
            
            if ($this->session->userdata('is_logged')) {
                $this->load->view('layout/header');
                $this->load->view('layout/navbar',$data);
                $this->load->view('aplicacion/index', $data);
                $this->load->view('layout/footer');
            }else{
                redirect(base_url('login'));
            }      	
        }

        public function guardar($id=null){
            $data = array();
            if($id){
                $aplicacion = $this->aplicacion_model->obtener_por_id($id); 
                $data['idAplicacion'] = $aplicacion->idAplicacion;
                $data['idEncuesta'] = $aplicacion->idEncuesta;
                $data['idPersona'] = $aplicacion->idPersona; 
            }else{
                $data['idAplicacion'] = null;
                $data['idEncuesta'] = null;
                $data['idPersona'] = null;
            }
            
            $data['menu'] = main_menu();
            $data['encuesta'] = $this->aplicacion_model->obtenerIdEncuesta();
            $data['persona'] = $this->aplicacion_model->obtenerIdPersona();

            $this->load->view('layout/header');
            $this->load->view('layout/navbar',$data);
            $this->load->view('aplicacion/guardar',$data);
            $this->load->view('layout/footer');
        }


        public function guardar_post($id=null){
            if($this->input->post()){
                $idEncuesta = $this->input->post('idEncuesta');
                $idPersona = $this->input->post('idPersona');
                $config = array(
                    array(
                        'field' => 'idEncuesta',
                        'label' => 'Nombre de Encuesta',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'idPersona',
                        'label' => 'Nombre de la Persona',
                        'rules' => 'required',
                    ),
                );

                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == TRUE){
                    $this->aplicacion_model->guardar($idEncuesta, $idPersona, $id);
                    redirect('aplicacion');
                }else{
                    $data = array();
                    $data['idAplicacion'] = $id;
                    $data['idEncuesta'] = $idEncuesta;
                    $data['idPersona'] = $idPersona;
                    
                    $this->load->view('layout/header');
                    $this->load->view('aplicacion/guardar', $data);
                    $this->load->view('layout/footer');
                }          	
            }else{
                $this->guardar();
            } 
        }

        /*public function ver($id){
            $data = array();
            $aplicacion = $this->aplicacion_model->obtener_por_id($id);
            $data['aplicacion'] = $aplicacion;

            $this->load->view('layout/header');
            $this->load->view('aplicacion/ver', $data);
            $this->load->view('layout/footer');
        }*/

        /* public function eliminar($id){
           $this->aplicacion_model->eliminar($id);
            redirect('aplicacion');
        } */
    }
?>