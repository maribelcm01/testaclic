<?php
class Users extends CI_Model{		
	function __construct(){
		$this->load->database();
	}

	public function create($datos){
		$datos = array(
			'nombre' => $datos['nombre'],
			'correo' => $datos['correo'],
			'contrasena' => $datos['contrasena'],
			'estatus' => 1,
			'rango' => 2,
		);

		if(!$this->db->insert('usuario',$datos)) {
			return false;
		}
		return true;
	}
}
?>