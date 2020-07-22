<?php 
	class Reactivo_model extends CI_Model { 
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
	
		public function guardar($idEncuesta, $reactivo, $comentario, $indice, $id=null){
			$data = array(
				'idEncuesta' => $idEncuesta,
				'reactivo' => $reactivo,
				'comentario' => $comentario,
				'indice' => $indice
			);
			if($id){
				$this->db->where('idReactivo', $id);
				$this->db->update('reactivo', $data);
			}else{
				$this->db->insert('reactivo', $data);
			} 
		}

		public function obtener_por_id($id){
			$this->db->select('idReactivo, idEncuesta, reactivo, comentario, indice');
			$this->db->from('reactivo');
			$this->db->where('idReactivo', $id);
			$consulta = $this->db->get();
			$resultado = $consulta->row();
			return $resultado;
		}

		public function obtener_todos($idEncuesta){
			$this->db->select('encuesta.nombre, reactivo.idReactivo, reactivo.idEncuesta,
					reactivo.reactivo, reactivo.comentario, reactivo.indice');
			$this->db->from('encuesta,reactivo');
			$this->db->where('encuesta.idEncuesta = reactivo.idEncuesta AND encuesta.idEncuesta ='.$idEncuesta);
			//$this->db->order_by('prioridad, titulo', 'asc');
			$consulta = $this->db->get();
			$resultado = $consulta->result();
			return $resultado;
		}

		public function obtenerIdEncuesta($idEncuesta){
		//buscamos los candidatos que no estan aplicando en esa encuesta
			$this->db->select('*');
			$this->db->from('encuesta');
			$this->db->where('idEncuesta = '.$idEncuesta);
			$consulta = $this->db->get();
			$resultado = $consulta->row();
			return $resultado;
		}

		public function obtener_por_idOpc($id){
			$this->db->select('idRespuesta, respuesta, indice, idReactivo');
			$this->db->from('respuesta');
			$this->db->where('idReactivo', $id);
			$consulta = $this->db->get();
			$resultado = $consulta->result();
			return $resultado;
		}

		public function obtener_por_indice($id,$indice){
			$this->db->select('idRespuesta, respuesta, indice, idReactivo');
			$this->db->from('respuesta');
			$this->db->where('idReactivo', $id);
			$this->db->where('indice', $indice);
			$consulta = $this->db->get();
			$resultado = $consulta->row();
			return $resultado;
		}

		public function guardarOpc($idRespuesta, $respuesta, $indice, $idReactivo){
			$data = array(
				'respuesta' => $respuesta,
				'indice' => $indice,
				'idReactivo' => $idReactivo
			);
			if($idRespuesta){
				$this->db->where('idRespuesta', $idRespuesta);
				$this->db->update('respuesta', $data);
			}else{
				$this->db->insert('respuesta', $data);
			}
		}

		/* public function eliminar($id){
			$this->db->where('idReactivo', $id);
			$this->db->delete('reactivo');
		} */
	}
?>