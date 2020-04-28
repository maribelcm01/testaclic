<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->load->helper(array('getmenu'));
		$this->load->model('Encuestas');
		$this->load->library('form_validation');

        $this->load->helper('url_helper');
        $this->load->helper('form');
	}

	public function index(){
		$data['menu'] = main_menu();
		$data['encuesta'] = $this->Encuestas->lista_encuesta();
        $data['title'] = 'Lista de Encuestas';

		$this->load->view('encuestas/encuesta',$data);
	}

	public function create(){
        $data['title'] = 'Crear Encuestas';
        $this->load->view('encuestas/create', $data);
    }
      
    public function edit($id){
        $id = $this->uri->segment(3);
        $data = array();
        if (empty($id)){ 
         	show_404();
        }else{
          $data['encuesta'] = $this->Encuestas->get_notes_by_id($id);
          $this->load->view('encuestas/edit', $data);
        }
    }

    public function store(){
    	$this->form_validation->set_rules('nombre', 'nombre', 'required');
 
        $id = $this->input->post('id');
 
        if ($this->form_validation->run() === FALSE)
        {  
            if(empty($id)){
              redirect( base_url('encuesta/create') ); 
            }else{
             redirect( base_url('encuesta/edit/'.$id) ); 
            }
        }
        else
        {
            $data['note'] = $this->Encuestas->createOrUpdate();
            redirect( base_url('encuesta') ); 
        }

    }
     
    public function delete(){
        $id = $this->uri->segment(3);
         
        if (empty($id))
        {
            show_404();
        }
                 
        $encuesta = $this->Encuestas->delete($id);
         
        redirect( base_url('encuesta') );        
    }

}
?>