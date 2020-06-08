<?php
    class Cleaver_model extends CI_Model{
		
		function __construct(){
			$this->load->database();
		}

		public function validarCodigo($codigo){
			$c = $this->db->select('codigo')->
					where('codigo' , $codigo)->
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
		
		public function verIdAplicacion($codigo){
			$e = $this->db->select('idAplicacion')->
					where(array('codigo'=>$codigo))->
					get('aplicacion')->
					result_array();
			$idAplicacion = $e[0]['idAplicacion'];
			return $idAplicacion;
		}
		
		public function obtenerDatos($codigo){
			$d = $this->db->select('encuestado.nombre, aplicacion.codigo')->
					where(array('encuestado.idEncuestado = aplicacion.idEncuestado AND aplicacion.codigo =' => $codigo))->
					get('aplicacion, encuestado')->
					row();
			return $d;
        }
        public function verIdEncuesta($codigo){
			$p = $this->db->select('idEncuesta')->
					where(array('codigo =' => $codigo))->
					get('aplicacion')->
					result_array();
					
			$idEncuesta = (count($p) > 0) ? $p[0]['idEncuesta'] : [];
			return $idEncuesta;
		}

		public function verNombreEncuesta($idEncuesta){
			$p = $this->db->select('encuesta.nombre')->
					where('aplicacion.idEncuesta = encuesta.idEncuesta AND aplicacion.idEncuesta = '.$idEncuesta)->
					get('aplicacion,encuesta')->
					result_array();
			$nombreEncuesta = (count($p) > 0) ? $p[0]['nombre'] : [] ;
			return $nombreEncuesta;
		}

		public function verIdReactivo($codigo,$indice){
			$p = $this->db->select('reactivo.idReactivo')->
					where(array('reactivo.idEncuesta = encuesta.idEncuesta AND
						encuesta.idEncuesta = aplicacion.idEncuesta AND
						aplicacion.codigo =' => $codigo, 'reactivo.indice =' => $indice))->
					get('encuesta, reactivo, aplicacion')->
					result_array();
			$idReactivo = $p[0]['idReactivo'];
			return $idReactivo;
		}

		public function obtenerPalabras($idEncuesta,$a,$b){
			$q = $this->db->select('idReactivo,reactivo')->
					where('idEncuesta ='.$idEncuesta.' AND indice BETWEEN '.$a.' AND '.$b)->
					get('reactivo')->
					result_array();
			return $q;
		}

		public function insertarRespuesta($idReactivo,$idAplicacion,$mas,$menos){
			$r = $this->db->query("INSERT INTO aplicacion_cleaver VALUES($idReactivo,$idAplicacion,$mas,$menos)
					ON DUPLICATE KEY UPDATE mas = $mas,menos = $menos;");
			if($r == true){return true;
			}else{return false;}
		}

		public function estadoFecha($idAplicacion){
			$data = array(
				'fechaConclusion' => date('Y-m-d'),
				'estado' => 'Finalizado'
			 );
			$this->db->where('idAplicacion', $idAplicacion);
			$this->db->update('aplicacion', $data);	
		}

		public function resultados($idAplicacion,$indice){
			$s = $this->db->select('reactivo.indice,aplicacion_cleaver.mas, aplicacion_cleaver.menos')->
					where('reactivo.idReactivo = aplicacion_cleaver.idReactivo AND
					aplicacion_cleaver.idAplicacion = '.$idAplicacion.' AND reactivo.indice= '.$indice)->
					get('aplicacion_cleaver,reactivo');//->
					//result();
			return $s->result();
		}
    }
?>