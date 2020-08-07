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
			$d = $this->db->select('encuestado.nombre,aplicacion.idAplicacion, aplicacion.codigo,aplicacion.finSesion,aplicacion.acabo')->
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
		public function verRespuesta($serie,$pregunta){
			$l = $this->db->select('respuesta')->
					where(array('serie =' => $serie, 'numero_pregunta =' => $pregunta))->
					get('hoja_respuestas')->
					result_array();
			$respuesta = $l[0]['respuesta'];
			return $respuesta;
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

		public function verCodigoSesion($codigo){
			$p = $this->db->select('idEncuesta,codigo,idAplicacion,sesion,finSesion')->
					where(array('codigo =' => $codigo))->
					get('aplicacion')->
					result_array();
					
			return $p;
        }
		public function actualizarPreguntaSesion($codigo,$contador){
			$data = array(
				'sesion' => $contador,
				'acabo' => ($contador == 0) ? 1 : 0
			 );
			$this->db->where('codigo', $codigo);
			$this->db->update('aplicacion', $data);	
			//$this->db->query("UPDATE aplicacion SET sesion = $contador WHERE codigo = $codigo;");
		}

		public function guardarFinSesion($codigo,$finSesion,$duracion_en_segundos){
			$data = array(
				'finSesion' => strval($finSesion),
				'sesion'  => $duracion_en_segundos
			 );
			$this->db->where('codigo', $codigo);
			$this->db->update('aplicacion', $data);	
			//$this->db->query("UPDATE aplicacion SET sesion = $contador WHERE codigo = $codigo;");
		}
		public function insertarRespuesta($idReactivo,$idAplicacion,$valor){
			$this->db->query("INSERT INTO aplicacion_terman VALUES($idReactivo,$idAplicacion,$valor)
					ON DUPLICATE KEY UPDATE valor = $valor;");
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