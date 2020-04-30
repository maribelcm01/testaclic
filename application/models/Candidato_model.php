<?php 

class Candidato_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->database();
   }
   
   	public function guardar($nombre, $telefono, $email, $id=null){
      	$data = array(
         	'nombre' => $nombre,
         	'telefono' => $telefono,
         	'email' => $email
      	);
      	if($id){
         	$this->db->where('idCandidato', $id);
         	$this->db->update('candidato', $data);
      	}else{
         	$this->db->insert('candidato', $data);
      	} 
   	}

   	public function eliminar($id){
       	$this->db->where('idCandidato', $id);
       	$this->db->delete('candidato');
   	}

   	public function obtener_por_id($id){
      	$this->db->select('idCandidato, nombre, telefono, email');
      	$this->db->from('candidato');
      	$this->db->where('idCandidato', $id);
      	$consulta = $this->db->get();
      	$resultado = $consulta->row();
      	return $resultado;
   	}

   	public function obtener_todos(){
      	$this->db->select('idCandidato, nombre, telefono, email');
      	$this->db->from('candidato');
      	//$this->db->order_by('prioridad, titulo', 'asc');
      	$consulta = $this->db->get();
      	$resultado = $consulta->result();
      	return $resultado;
   	}
}

 ?>