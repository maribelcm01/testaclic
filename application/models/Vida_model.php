<?php 
	class Vida_model extends CI_Model{
		
		function __construct(){
			$this->load->database();
		}

		public function validarCodigo($codigo){
			$c = $this->db->select('codigo')->
					where(array('codigo'=>$codigo))->
					get('aplicacion')->
					row();
			return $c;
		}

		public function verEstado($codigo){
			$e = $this->db->select('estado')->
					where(array('codigo'=>$codigo))->
					get('aplicacion')->
					result_array();
			$estado = $e[0]['estado'];
			return $estado;
		}
		
		public function obtenerDatos($codigo){
			$d = $this->db->select('encuestado.nombre, aplicacion.codigo')->
					where(array('aplicacion.codigo =' => $codigo))->
					get('aplicacion, encuestado')->
					row();
			return $d;
		}

		public function verLimite($codigo){
			$l = $this->db->select_max('reactivo.indice')->
					where(array('aplicacion.idEncuesta = encuesta.idEncuesta AND
							reactivo.idEncuesta = encuesta.idEncuesta AND
							aplicacion.codigo =' => $codigo))->
					get('aplicacion, encuesta, reactivo')->
					result_array();
			$indice = $l[0]['indice'];
			return $indice;
		}

		public function verPregunta($codigo){
			$p = $this->db->select('aplicacion.pregunta')->
					where(array('aplicacion.idEncuesta = encuesta.idEncuesta AND
							aplicacion.codigo =' => $codigo))->
					get('aplicacion, encuesta')->
					result_array();
			$pregunta = $p[0]['pregunta'];
			return $pregunta;
		}

		public function verIdAplicacion($codigo){
			$p = $this->db->select('idAplicacion')->
					where(array('codigo =' => $codigo))->
					get('aplicacion')->
					result_array();
			$idAplicacion = $p[0]['idAplicacion'];
			return $idAplicacion;
		}

		public function verIdReactivo($codigo,$pregunta){
			$p = $this->db->select('reactivo.idReactivo')->
					where(array('reactivo.idEncuesta = encuesta.idEncuesta AND
						encuesta.idEncuesta = aplicacion.idEncuesta AND
						aplicacion.codigo =' => $codigo, 'reactivo.indice =' => $pregunta))->
					get('encuesta, reactivo, aplicacion')->
					result_array();
			$idReactivo = $p[0]['idReactivo'];
			return $idReactivo;
		}

		public function verDatos($codigo,$idReactivo){
			$q = $this->db->select('encuestado.nombre, reactivo.idReactivo, reactivo.reactivo ,aplicacion.codigo')->
					where(array('aplicacion.codigo =' => $codigo, 'reactivo.idReactivo =' => $idReactivo))->
					get('reactivo,aplicacion,encuestado')->
					row();
			return $q;
		}
		
		public function registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor){
			$consulta = $this->db->query("INSERT INTO aplicaciondetalle
					VALUES($idAplicacion,$idReactivo,$valor)
					ON DUPLICATE KEY UPDATE valor = $valor;");
			if($consulta==true){
				return true;
			}else{
				return false;
			}	
		}
		public function ultimaRegistrada($pregunta,$idAplicacion){
			$consulta = $this->db->query("UPDATE aplicacion SET pregunta = $pregunta WHERE idAplicacion = $idAplicacion;");
			if($consulta==true){
				return true;
			}else{
				return false;
			}	
		}

		public function estadoFecha($idAplicacion){
			$data = array(
				'fechaConclusion' => date('Y-m-d'),
				'estado' => 'Finalizado'
			 );
			$this->db->where('idAplicacion', $idAplicacion);
			$this->db->update('aplicacion', $data);
			
		}
		
	}
 ?>