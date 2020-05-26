<?php 
	class Encuesta_model extends CI_Model { 
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
	
		public function guardar($nombre, $id=null){
			$data = array(
				'nombre' => $nombre,
				'estado' => intval(1)
			);
			if($id){
				$this->db->where('idEncuesta', $id);
				$this->db->update('encuesta', $data);
			}else{
				$this->db->insert('encuesta', $data);
			} 
		}

		public function obtener_por_id($id){
			$this->db->select('idEncuesta, nombre');
			$this->db->from('encuesta');
			$this->db->where('idEncuesta', $id);
			$consulta = $this->db->get();
			$resultado = $consulta->row();
			return $resultado;
		}

		public function obtener_todos(){
			$this->db->select('*');
			$this->db->from('encuesta');
			//$this->db->order_by('prioridad, titulo', 'asc');
			$consulta = $this->db->get();
			$resultado = $consulta->result();
			return $resultado;
		}

		public function verEstado($idEncuesta){
			$p = $this->db->select('estado')->
					where('idEncuesta = '.$idEncuesta)->
					get('encuesta')->
					result_array();
			$estado = $p[0]['estado'];
			return $estado;
		}

		public function cambiarEstado($estado,$idEncuesta){
			$this->db->query("UPDATE encuesta SET estado = $estado WHERE idEncuesta = $idEncuesta;");
		}

		/* public function eliminar($id){
			$this->db->where('idEncuesta', $id);
			$this->db->delete('encuesta');
		} */
	}
?>