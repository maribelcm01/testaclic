<?php 
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

    class Reactivo extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library(array('form_validation','session'));
            $this->load->helper(array('auth/login_rules'));
            $this->load->model('Auth');
            $this->load->helper(array('getmenu'));
        }
      
        public function index($idEncuesta) {
            $data = array();
            
            $this->load->model('reactivo_model');
            $e = $this->reactivo_model->obtenerIdEncuesta($idEncuesta);
            $data['reactivo'] = $this->reactivo_model->obtener_todos($idEncuesta);
            $data['idEncuesta'] = $e->idEncuesta;
            $data['nombre'] = $e->nombre;
            $data['menu'] = main_menu();

            if ($this->session->userdata('is_logged')) {
                $this->load->view('layout/header');
                $this->load->view('layout/navbar',$data);
                $this->load->view('reactivo/index',$data);
                $this->load->view('layout/footer');
            }else{
                redirect(base_url('login'));
            }
        }

        public function guardar($idEncuesta,$id=null){
            $data = array(); 
            $this->load->model('reactivo_model');
            if($id){
                $reactivo = $this->reactivo_model->obtener_por_id($id); 
                $data['idReactivo'] = $reactivo->idReactivo;
                $data['idEncuesta'] = $reactivo->idEncuesta;
                $data['reactivo'] = $reactivo->reactivo;
                $data['comentario'] = $reactivo->comentario;
                $data['indice'] = $reactivo->indice;
            }else{
                $data['idReactivo'] = null;
                $data['idEncuesta'] = $idEncuesta;
                $data['reactivo'] = null;
                $data['comentario'] = null;
                $data['indice'] = null;
            }

            //$data['encuesta'] = $this->reactivo_model->obtenerIdEncuesta();
            $data['menu'] = main_menu();
            $e = $this->reactivo_model->obtenerIdEncuesta($idEncuesta);
            $data['nombre'] = $e->nombre;

            $this->load->view('layout/header');
            $this->load->view('layout/navbar',$data);
            $this->load->view('reactivo/guardar',$data);
            $this->load->view('layout/footer');
        }


        public function guardar_post($idEncuesta,$id=null){
            if($this->input->post()){
                $reactivo = $this->input->post('reactivo');
                $comentario = $this->input->post('comentario');
                $indice = $this->input->post('indice');


                $config = array(
                    array(
                        'field' => 'reactivo',
                        'label' => 'Reactivo',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'comentario',
                        'label' => 'Comentario',
                        'rules' => '',
                    ),
                    array(
                        'field' => 'indice',
                        'label' => 'Indice',
                        'rules' => 'required',
                    ),
                );

                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == TRUE){
                    $this->load->model('reactivo_model');
                    $this->reactivo_model->guardar($idEncuesta, $reactivo, $comentario, $indice, $id);
                    redirect('reactivo/index/'.$idEncuesta);
                }else{
                  $data = array();
                  $data['idReactivo'] = $id;
                  $data['idEncuesta'] = $idEncuesta;
                  $data['reactivo'] = $reactivo;
                  $data['comentario'] = $comentario;
                  $data['indice'] = $indice;

                  $this->load->view('layout/header');
                  $this->load->view('reactivo/guardar', $data);
                  $this->load->view('layout/footer');
                }          	
            }else{
                $this->guardar($idEncuesta);
            } 
        }

        /*public function ver($id){
            $data = array();
            $this->load->model('reactivo_model');
            $reactivo = $this->reactivo_model->obtener_por_id($id);
            $data['reactivo'] = $reactivo;

            $this->load->view('layout/header');
            $this->load->view('reactivo/ver', $data);
            $this->load->view('layout/footer');
        }*/

        /*public function eliminar($id){
            $this->load->model('reactivo_model');
            $this->reactivo_model->eliminar($id);
            redirect('reactivo');
        }*/
    }
?>