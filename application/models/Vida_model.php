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
	
	//mahrko
	public function encuestas(){
		$this->db->select('idEncuesta,nombre');
		$this->db->from('encuesta');
		$consulta = $this->db->get();
		$resultado = $consulta->result();
		return $resultado;
	}
	public function encuesta($id){
		$this->db->select('idEncuesta,nombre');
		$this->db->from('encuesta');
		$this->db->where('idEncuesta', $id);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		return $resultado;
	}
	public function candidatos_esta_encuesta($id){
		$this->db->select('a.*,d.*');
		$this->db->from('candidato a');
		$this->db->join('aplicacion d', 'a.idCandidato = d.idCandidato and  d.idEncuesta = '.$id);

		$consulta = $this->db->get();
		$resultado = $consulta->result();
		return $resultado;
	}
	public function candidatos_para_encuesta($id){
		//buscamos los candidatos que no estan aplicando en esa encuesta
		$consulta=$this->db->query("SELECT * FROM candidato t1 WHERE NOT EXISTS (SELECT NULL FROM aplicacion t2 WHERE t2.idCandidato = t1.idCandidato and t2.idEncuesta = {$id} )");
		$resultado = $consulta->result();
		return $resultado;
		
	}
	public function registrar_candidato_en_aplicacion($candidato_id,$encuesta_id){
		$data_aplicacion = array(
			'idEncuesta' => intval($encuesta_id),
			'idCandidato' => intval($candidato_id),
			'codigo' => bin2hex(random_bytes(6)),
			'fechaCreacion' => date('Y-m-d'),
			'estado' => 'P',
		);
		$this->db->insert('aplicacion', $data_aplicacion);

		$data_estado_aplicacion = array(
			'idEncuesta' => intval($encuesta_id),
			'idCandidato' => intval($candidato_id),
			'num_pregunta_estado' => 1,
			'estado' => 0, //estado de finalizado 0 false 1 true
			'resultado' => 0,
		);
		$this->db->insert('estado_aplicacion', $data_estado_aplicacion);
		
	}
	public function estoy_en_pregunta($encuesta_id,$candidato_id){
		$this->db->select('num_pregunta_estado');
		$this->db->from('estado_aplicacion');
		$this->db->where('idCandidato', $candidato_id);
		$this->db->where('idEncuesta', $encuesta_id);
		$this->db->where('estado', 0);
		$consulta = $this->db->get();
		$resultado = $consulta->result();
		return $resultado;
	}
	public function candidato_info($id){
		$this->db->select('idCandidato,nombre,email');
		$this->db->from('candidato');
		$this->db->where('idCandidato', $id);
		$consulta = $this->db->get();
		
		$resultado = $consulta->row();
		//print_r($resultado);exit;
		return $resultado;
	}
	public function pregunta_actual($encuesta_id,$estoy_en_pregunta){
		$this->db->select('*');
		$this->db->from('reactivo');
		$this->db->where('idEncuesta', $encuesta_id);
		$this->db->where('indice', intval($estoy_en_pregunta));
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		//print_r($resultado);exit;
		return $resultado;
	}
	public function candidato_para_responder($encuesta_id,$candidato_id){
		//buscamos info del candidato a rsponder
		$this->db->select('a.*,d.*');
		$this->db->from('candidato a');
		$this->db->join('aplicacion d', 'a.idCandidato = d.idCandidato and  d.idEncuesta = '.$encuesta_id);
		$this->db->where('a.idCandidato', $candidato_id);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		//print_r($resultado);exit;
		return $resultado;
		
	}
	public function guardarRespuestaApp($reactivo_indice,$reactivo_respuesta,$reactivo_id,$candidato_id,$encuesta_id,$aplicacion_id){
		$data_resultado_reactivo = array(
			'idReactivo' => intval($reactivo_id),
			'valor' => intval($reactivo_respuesta),
			'idAplicacion' =>intval($aplicacion_id),
			'idCandidato' => intval($candidato_id),
		);
		$this->db->insert('aplicaciondetalle', $data_resultado_reactivo);

		$this->db->select('*');
		$this->db->from('reactivo');
		$this->db->where('idEncuesta', $encuesta_id);
		$consulta = $this->db->get();
		$resultado = $consulta->num_rows();
		////print_r($resultado);exit;
		//verifica si esta es la ultima pregunta
		$finalizado = 0;
		
		if($resultado == $reactivo_indice){
			//completado 
			$finalizado =1;
		}
		$reactivo_indice= ($finalizado == 1) ?  $reactivo_indice : ($reactivo_indice+1);
		$data_estado_aplicacion_update = array(
			'idEncuesta' => intval($encuesta_id),
			'idCandidato' => intval($candidato_id),
			'num_pregunta_estado' => $reactivo_indice,
			'estado' => $finalizado, //estado de finalizado 0 false 1 true
			'resultado' => 0,
		);
		$this->db->where('idEncuesta', $encuesta_id);
		$this->db->update('estado_aplicacion', $data_estado_aplicacion_update);

		//si finalizado == 1 poemos en F aplicacion
		if($finalizado == 1){
			$data_aplicacion_update = array(
				'estado' => 'F', //estado de finalizado 0 false 1 true
				'fechaConclusion' => date('Y-m-d')
			);
			$this->db->where('idAplicacion', $aplicacion_id);
			$this->db->update('aplicacion', $data_aplicacion_update);
		}	
		return [$finalizado,$reactivo_indice];
	}
	
}
 ?>