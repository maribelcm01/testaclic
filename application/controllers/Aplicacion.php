<?php 
if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Aplicacion extends CI_Controller{
	public function __construct(){
		parent::__construct();
        $this->load->library(array('form_validation','session'));
        $this->load->helper(array('auth/login_rules'));
        $this->load->model('Auth');
        $this->load->helper(array('getmenu'));
    }

    public function index() {
        $data = array();

        $data['menu'] = main_menu();
      	
        $this->load->model('aplicacion_model');
      	$data['aplicacion'] = $this->aplicacion_model->obtener_todos();
      	
        if ($this->session->userdata('is_logged')) {
            $this->load->view('aplicacion/header');
            $this->load->view('layout/navbar',$data);
            $this->load->view('aplicacion/index', $data);
            $this->load->view('layout/footer');
        }else{
            redirect(base_url('login'));
        }      	
    }
       /*public function ver($id){
      	$data = array();
      	$this->load->model('aplicacion_model');
      	$aplicacion = $this->aplicacion_model->obtener_por_id($id);
      	$data['aplicacion'] = $aplicacion;

      	$this->load->view('aplicacion/header');
      	$this->load->view('aplicacion/ver', $data);
      	$this->load->view('layout/footer');
   	}*/

   	public function guardar($id=null){
        $data = array(); 
        $this->load->model('aplicacion_model');
        if($id){
            $aplicacion = $this->aplicacion_model->obtener_por_id($id); 
            $data['idAplicacion'] = $aplicacion->idAplicacion;
            $data['idEncuesta'] = $aplicacion->idEncuesta;
            $data['idEncuestado'] = $aplicacion->idEncuestado;
            
        }else{
            $data['idAplicacion'] = null;
            $data['idEncuesta'] = null;
            $data['idEncuestado'] = null;
            
        }

        $data['encuesta'] = $this->aplicacion_model->obtenerIdEncuesta();
        $data['encuestado'] = $this->aplicacion_model->obtenerIdEncuestado();

        $this->load->view('aplicacion/header');
        $this->load->view('aplicacion/guardar', $data);
        $this->load->view('layout/footer');
    }


     public function guardar_post($id=null){
        if($this->input->post()){
            $idEncuesta = $this->input->post('idEncuesta');
            $idEncuestado = $this->input->post('idEncuestado');


            $config = array(
                array(
                    'field' => 'idEncuesta',
                    'label' => 'Nombre de Encuesta',
                    'rules' => 'required',
                ),
                array(
                    'field' => 'idEncuestado',
                    'label' => 'Nombre del Encuestado',
                    'rules' => 'required',
                ),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE){
                $this->load->model('aplicacion_model');
                $this->aplicacion_model->guardar($idEncuesta, $idEncuestado, $id);
                redirect('aplicacion');
            }else{
                $data = array();
                $data['idAplicacion'] = $id;
                $data['idEncuesta'] = $idEncuesta;
                $data['idEncuestado'] = $idEncuestado;
                
                $this->load->view('aplicacion/header');
                $this->load->view('aplicacion/guardar', $data);
                $this->load->view('layout/footer');
            }          	
        }else{
             $this->guardar();
        } 
    }


     public function eliminar($id){
        $this->load->model('aplicacion_model');
        $this->aplicacion_model->eliminar($id);
        redirect('aplicacion');
    }
}
?>