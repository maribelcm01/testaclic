<?php 
	class Persona_model extends CI_Model { 
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
				$this->db->where('idPersona', $id);
				$this->db->update('persona', $data);
			}else{
				$this->db->insert('persona', $data);
			} 
		}

		public function obtener_por_id($id){
			$this->db->select('idPersona, nombre, telefono, email');
			$this->db->from('persona');
			$this->db->where('idPersona', $id);
			$consulta = $this->db->get();
			$resultado = $consulta->row();
			return $resultado;
		}

		public function obtener_todos(){
			$this->db->select('*');
			$this->db->from('persona');
			//$this->db->order_by('prioridad, titulo', 'asc');
			$consulta = $this->db->get();
			$resultado = $consulta->result();
			return $resultado;
		}

		/* public function eliminar($id){
			$this->db->where('idPersona', $id);
			$this->db->delete('persona');
		} */
	}
?>