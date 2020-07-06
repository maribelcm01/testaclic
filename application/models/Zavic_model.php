<?php
    class Zavic_model extends CI_Model{
		
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

        public function verIdEncuesta($codigo){
			$p = $this->db->select('idEncuesta')->
					where(array('codigo =' => $codigo))->
					get('aplicacion')->
					result_array();
					
			$idEncuesta = (count($p) > 0) ? $p[0]['idEncuesta'] : [];
			return $idEncuesta;
		}

		public function verIdAplicacion($codigo){
			$e = $this->db->select('idAplicacion')->
					where(array('codigo'=>$codigo))->
					get('aplicacion')->
					result_array();
			$idAplicacion = $e[0]['idAplicacion'];
			return $idAplicacion;
		}

		public function verNombreEncuesta($idEncuesta){
			$p = $this->db->select('encuesta.nombre')->
					where('aplicacion.idEncuesta = encuesta.idEncuesta AND aplicacion.idEncuesta = '.$idEncuesta)->
					get('aplicacion,encuesta')->
					result_array();
			$nombreEncuesta = (count($p) > 0) ? $p[0]['nombre'] : [] ;
			return $nombreEncuesta;
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

		public function busca_menor_mayor($idEncuesta){
			$this->db->select('indice');
			$this->db->from('reactivo');
			$this->db->order_by('indice','asc');
			$this->db->where('idEncuesta',$idEncuesta);
			$query=$this->db->get();
			$row=$query->result_array();
			$first = $row[0];
			$last = $row[count($row)-1];
			return [$first,$last];
		}

        public function obtenerDatos($codigo){
			$d = $this->db->select('encuestado.nombre,aplicacion.idAplicacion, aplicacion.codigo')->
					where(array('encuestado.idEncuestado = aplicacion.idEncuestado AND aplicacion.codigo =' => $codigo))->
					get('aplicacion, encuestado')->
					row();
			return $d;
		}
		
		public function obtenerPregunta($codigo){
			$d = $this->db->select('reactivo.idReactivo,reactivo.reactivo, rpta_zavic.respuesta')->
					where(array('reactivo.idReactivo = rpta_zavic.idReactivo AND
					reactivo.indice = aplicacion.pregunta AND aplicacion.codigo =' => $codigo))->
					get('reactivo,rpta_zavic,aplicacion')->
					result_array();
			return $d;
		}
		public function obtenerPreguntaBack($codigo,$pregunta){
			$d = $this->db->select('reactivo.idReactivo,reactivo.reactivo, rpta_zavic.respuesta,
					aplicacion_zavic.A, aplicacion_zavic.B, aplicacion_zavic.C, aplicacion_zavic.D')->
					where(array('reactivo.idReactivo = rpta_zavic.idReactivo AND
					aplicacion_zavic.idAplicacion = aplicacion.idAplicacion AND
					reactivo.idReactivo = aplicacion_zavic.idReactivo AND
					reactivo.indice = '.$pregunta.' AND aplicacion.codigo =' => $codigo))->
					get('reactivo,rpta_zavic,aplicacion,aplicacion_zavic')->
					result_array();
			return $d;
		}
		
		public function verPregunta($codigo){
			$l = $this->db->select('pregunta')->
					where('codigo', $codigo)->
					get('aplicacion')->
					result_array();
			$pregunta = $l[0]['pregunta'];
			return $pregunta;
		}
		
		public function insertarRespuesta($idReactivo,$idAplicacion,$A,$B,$C,$D){
			$this->db->query("INSERT INTO aplicacion_zavic VALUES($idReactivo,$idAplicacion,$A,$B,$C,$D)
					ON DUPLICATE KEY UPDATE A = $A,B = $B,C = $C,D = $D;");
		}

		public function actualizarPregunta($pregunta,$idAplicacion){
			$this->db->query("UPDATE aplicacion SET pregunta = $pregunta WHERE idAplicacion = $idAplicacion;");
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