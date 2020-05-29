<?php
    class Cleaver_model extends CI_Model{
		
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
			$idEncuesta = $p[0]['idEncuesta'];
			return $idEncuesta;
		}

		public function verNombreEncuesta($idEncuesta){
			$p = $this->db->select('encuesta.nombre')->
					where('aplicacion.idEncuesta = encuesta.idEncuesta AND aplicacion.idEncuesta = '.$idEncuesta)->
					get('aplicacion,encuesta')->
					result_array();
			$nombreEncuesta = $p[0]['nombre'];
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
			$q = $this->db->select('reactivo')->
					where('idEncuesta ='.$idEncuesta.' AND indice BETWEEN '.$a.' AND '.$b)->
					get('reactivo')->
					result();
			return $q;
		}
    }
?>