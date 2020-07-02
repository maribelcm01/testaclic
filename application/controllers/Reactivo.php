<?php 
    if (!defined('BASEPATH'))  exit('No direct script access allowed');

    class Reactivo extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library(array('form_validation','session'));
            $this->load->helper(array('auth/login_rules'));
            $this->load->model('reactivo_model');
            $this->load->helper(array('getmenu'));
            $this->load->model('Auth');
        }
      
        public function index($idEncuesta) {
            $data = array();
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

            $data['menu'] = main_menu();
            $e = $this->reactivo_model->obtenerIdEncuesta($idEncuesta);
            $data['nombre'] = $e->nombre;

            if ($this->session->userdata('is_logged')) {
                $this->load->view('layout/header');
                $this->load->view('layout/navbar',$data);
                $this->load->view('reactivo/guardar',$data);
                $this->load->view('layout/footer');
            }else{
                redirect(base_url('login'));
            }
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

        public function guardarOpc($idEncuesta,$idReactivo=null){
            $reactivo = $this->reactivo_model->obtener_por_idOpc($idReactivo);
            if($reactivo == null){   
                $data = array(
                    'menu' => main_menu(),
                    'idEncuesta' => $idEncuesta,
                    'idReactivo' =>$idReactivo,
                    'respuestaA' => null,
                    'respuestaB' => null,
                    'respuestaC' => null,
                    'respuestaD' => null,
                    'idRespuestaA' => '',
                    'idRespuestaB' => null,
                    'idRespuestaC' => null,
                    'idRespuestaD' => null,
                    'indiceA' => 1,
                    'indiceB' => 2,
                    'indiceC' => 3,
                    'indiceD' => 4
                );
            }else{      
                $data = array(
                    'menu' => main_menu(),
                    'idEncuesta' => $idEncuesta,
                    'idReactivo' =>$idReactivo,
                    'respuestaA' => $reactivo[0]['respuesta'],
                    'respuestaB' => $reactivo[1]['respuesta'],
                    'respuestaC' => $reactivo[2]['respuesta'],
                    'respuestaD' => $reactivo[3]['respuesta'],
                    'idRespuestaA' => $reactivo[0]['idRespuesta'],
                    'idRespuestaB' => $reactivo[1]['idRespuesta'],
                    'idRespuestaC' => $reactivo[2]['idRespuesta'],
                    'idRespuestaD' => $reactivo[3]['idRespuesta'],
                    'indiceA' => $reactivo[0]['indice'],
                    'indiceB' => $reactivo[1]['indice'],
                    'indiceC' => $reactivo[2]['indice'],
                    'indiceD' => $reactivo[3]['indice']
                );
            }
            
            if ($this->session->userdata('is_logged')) {
                $this->load->view('layout/header');
                $this->load->view('layout/navbar',$data);
                $this->load->view('reactivo/opciones',$data);
                $this->load->view('layout/footer');
            }else{
                redirect(base_url('login'));
            }
        }

        public function guardar_postOpc($idEncuesta,$idReactivo){
            if($this->input->post()){
                $idRespuestaA = $this->input->post('idRespuestaA');
                $respuestaA = $this->input->post('respuestaA');
                $indiceA = $this->input->post('indiceA');
                $idRespuestaB = $this->input->post('idRespuestaB');
                $respuestaB = $this->input->post('respuestaB');
                $indiceB = $this->input->post('indiceB');
                $idRespuestaC = $this->input->post('idRespuestaC');
                $respuestaC = $this->input->post('respuestaC');
                $indiceC = $this->input->post('indiceC');
                $idRespuestaD = $this->input->post('idRespuestaD');
                $respuestaD = $this->input->post('respuestaD');
                $indiceD = $this->input->post('indiceD');
                
                $this->reactivo_model->guardarOpc($idRespuestaA, $respuestaA, $indiceA, $idReactivo);
                $this->reactivo_model->guardarOpc($idRespuestaB, $respuestaB, $indiceB, $idReactivo);
                $this->reactivo_model->guardarOpc($idRespuestaC, $respuestaC, $indiceC, $idReactivo);
                $this->reactivo_model->guardarOpc($idRespuestaD, $respuestaD, $indiceD, $idReactivo);
                redirect('reactivo/index/'.$idEncuesta);
            }else{
                $this->guardarOpc($idEncuesta);
            } 
        }

        /*public function ver($id){
            $data = array();
            $reactivo = $this->reactivo_model->obtener_por_id($id);
            $data['reactivo'] = $reactivo;

            $this->load->view('layout/header');
            $this->load->view('reactivo/ver', $data);
            $this->load->view('layout/footer');
        }*/

        /*public function eliminar($id){
            $this->reactivo_model->eliminar($id);
            redirect('reactivo');
        }*/
    }
?>