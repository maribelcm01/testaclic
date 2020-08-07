<?php
    class Terman_model extends CI_Model{
		
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
        
        public function verNombreEncuesta($idEncuesta){
			$p = $this->db->select('encuesta.nombre')->
					where('aplicacion.idEncuesta = encuesta.idEncuesta AND aplicacion.idEncuesta = '.$idEncuesta)->
					get('aplicacion,encuesta')->
					result_array();
			$nombreEncuesta = (count($p) > 0) ? $p[0]['nombre'] : [] ;
			return $nombreEncuesta;
        }
        public function obtenerDatos($codigo){
			$d = $this->db->select('encuestado.nombre,aplicacion.idAplicacion, aplicacion.codigo')->
					where(array('encuestado.idEncuestado = aplicacion.idEncuestado AND aplicacion.codigo =' => $codigo))->
					get('aplicacion, encuestado')->
					row();
			return $d;
		}
		public function datosST($estado){
			$d = $this->db->select("*")->
					where("serie",$estado)->
					get("info_terman")->
					row();
			return $d;
		}
		public function verSerie($codigo){
			$e = $this->db->select('serie')->
					where(array('codigo'=>$codigo))->
					get('aplicacion')->
					result_array();
			$serie = $e[0]['serie'];
			return $serie;
		}
		public function verPregunta($codigo){
			$l = $this->db->select('pregunta')->
					where('codigo', $codigo)->
					get('aplicacion')->
					result_array();
			$pregunta = $l[0]['pregunta'];
			return $pregunta;
		}
		public function verLimite($codigo,$serie){
			$l = $this->db->select_max('reactivo.indice')->
					where(array('aplicacion.idEncuesta = encuesta.idEncuesta AND
							reactivo.idEncuesta = encuesta.idEncuesta AND
							aplicacion.codigo =' => $codigo,'reactivo.comentario = ' => $serie))->
					get('aplicacion, encuesta, reactivo')->
					result_array();
			$indice = $l[0]['indice'];
			return $indice;
		}
		public function cambiarSerie($codigo,$serie){
				$data = array('serie' => $serie);
				$this->db->where('codigo',$codigo);
        		$this->db->update('aplicacion',$data);
		}
		public function cambiarPregunta($codigo){
			$data = array('pregunta' => 1);
			$this->db->where('codigo',$codigo);
			$this->db->update('aplicacion',$data);
		}
		public function obtenerPregunta($codigo,$serie){
			$d = $this->db->select('reactivo.idReactivo, reactivo.reactivo, reactivo.indice AS indiceR')->
                    where(array('reactivo.indice = aplicacion.pregunta
					AND aplicacion.codigo =' => $codigo,'reactivo.comentario =' => $serie))->
					get('reactivo,aplicacion')->
					result();
			return $d;
		}
		public function obtenerRespuesta($codigo,$serie){
			$d = $this->db->select('respuesta.respuesta, respuesta.indice,')->
                    where(array('reactivo.indice = aplicacion.pregunta
					AND respuesta.idReactivo = reactivo.idReactivo AND aplicacion.codigo =' => $codigo,
					'reactivo.comentario =' => $serie))->
					get('reactivo,respuesta,aplicacion')->
					result();
			return $d;
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