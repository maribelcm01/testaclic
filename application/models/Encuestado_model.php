<?php 
	class Encuestado_model extends CI_Model { 
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
				$this->db->where('idEncuestado', $id);
				$this->db->update('encuestado', $data);
			}else{
				$this->db->insert('encuestado', $data);
			} 
		}

		public function obtener_por_id($id){
			$this->db->select('idEncuestado, nombre, telefono, email');
			$this->db->from('encuestado');
			$this->db->where('idEncuestado', $id);
			$consulta = $this->db->get();
			$resultado = $consulta->row();
			return $resultado;
		}

		public function obtener_todos(){
			$this->db->select('*');
			$this->db->from('encuestado');
			//$this->db->order_by('prioridad, titulo', 'asc');
			$consulta = $this->db->get();
			$resultado = $consulta->result();
			return $resultado;
		}

		/* public function eliminar($id){
			$this->db->where('idEncuestado', $id);
			$this->db->delete('encuestado');
		} */
	}
?>