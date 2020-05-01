<?php 
/**
 * 
 */
class Vida_model extends CI_Model{
	
	function __construct(){
		$this->load->database();
	}

	public function verId(){
		$res = $this->db->select_min('idReactivo')->
				get('reactivo')->
				result_array();
		$id = $res[0]['idReactivo'];
        return $id;
	}

	public function reactivo($id){
		$q = $this->db->
				where(array('idReactivo'=>$id))->
				get('reactivo')->
				result_array();
		return $q;
	}

	public function mostraridAplicacionM($codigo){
		$q = $this->db->select('idAplicacion')->
				where(array('codigo'=>$codigo))->
				get('aplicacion')->
				result_array();

		//query("SELECT idAplicacion FROM aplicacion WHERE codigo = $codigo");
		return $q;
	}

	public function mostrarLimite(){
		$l = $this->db->select_max('idReactivo')->
				get('reactivo')->
				result_array();
		$id = $l[0]['idReactivo'];
        return $id;
	}

	public function registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor){
       	$consulta=$this->db->query("INSERT INTO aplicaciondetalle VALUES(NULL,$idAplicacion,$idReactivo,$valor);");
       	if($consulta==true){
        	return true;
      	}else{
        	return false;
    	}			
    }
	
}
 ?>