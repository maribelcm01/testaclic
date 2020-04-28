<?php 
/**
 * 
 */
class Auth extends CI_Model{
	function __construct(){
		$this->load->database();
	}

	public function login($usuario,$contrasena){
		$data = $this->db->get_where('usuario',array('nombre' => $usuario, 'contrasena' => $contrasena),1);
		if (!$data->result()) {
			return false;
		}
		return $data->row();
	}
}
 ?>