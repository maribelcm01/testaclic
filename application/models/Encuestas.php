<?php

class Encuestas extends CI_Model {
  
    public function __construct()
    {
        $this->load->database();
    }
     
    public function lista_encuesta(){
        $query = $this->db->get('encuesta');
        return $query->result();
    }

    public function get_notes_by_id($id){
        $query = $this->db->get_where('encuesta', array('idEncuesta' => $id));
        return $query->row();
    }
     
    public function createOrUpdate(){
        $this->load->helper('url');
        $id = $this->input->post('idEncuesta');
 
        $data = array(
            'nombre' => $this->input->post('nombre')
        );
        if (empty($id)) {
            return $this->db->insert('encuesta', $data);
        } else {
            $this->db->where('idEncuesta', $id);
            return $this->db->update('encuesta', $data);
        }
    }
     
    public function delete($id){
        $this->db->where('idEncuesta', $id);
        return $this->db->delete('encuesta');
    }
}    
 ?>