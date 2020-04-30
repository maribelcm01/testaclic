<?php 
/**
 * 
 */
class Vida_model extends CI_Model{
	
	function __construct(){
		$this->load->database();
	}

	public function reactivos(){
		//$consulta = $this->db->query("SELECT * FROM reactivo"); 
		//$resultado = $consulta->result();
		//return $resultado;

		$query = $this->db->get('reactivo');
        return $query->result();
	}

	public function get_candidato_by_code(){
		//SELECT candidato.nombre FROM candidato,aplicacion WHERE candidato.idCandidato = aplicacion.idCandidato and aplicacion.codigo='Ds46sx1'
		$query = $this->db->get_where('aplicacion', array('codigo' => $codigo));
        return $query->row();
	}
}
 ?>