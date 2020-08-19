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
			$d = $this->db->select('encuestado.nombre,aplicacion.idAplicacion, aplicacion.codigo,aplicacion.finSesion,aplicacion.acabo,aplicacion.pregunta')->
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
		public function obtenerPregunta($codigo,$serie){
			$d = $this->db->select('reactivo.idReactivo, reactivo.reactivo, reactivo.indice AS indiceR')->
                    where(array('reactivo.indice = aplicacion.pregunta
					AND aplicacion.codigo =' => $codigo,'reactivo.comentario =' => $serie))->
					get('reactivo,aplicacion')->
					result();
			return $d;
		}
		public function obtenerPreguntaBack($codigo,$serie,$pregunta){
			$d = $this->db->select('reactivo.idReactivo, reactivo.reactivo, reactivo.indice AS indiceR')->
                    where(array('reactivo.indice = ' => $pregunta,
					'aplicacion.codigo =' => $codigo,'reactivo.comentario =' => $serie))->
					get('reactivo,aplicacion')->
					result();
			return $d;
		}
		public function obtenerRespuesta($codigo,$serie){
			$d = $this->db->select('respuesta.respuesta, respuesta.indice')->
                    where(array('reactivo.indice = aplicacion.pregunta
					AND respuesta.idReactivo = reactivo.idReactivo AND aplicacion.codigo =' => $codigo,
					'reactivo.comentario =' => $serie))->
					get('reactivo,respuesta,aplicacion')->
					result();
			return $d;
		}
		public function obtenerRespuestaBack($codigo,$serie,$pregunta){
			$d = $this->db->select('respuesta.respuesta, respuesta.indice')->
                    where(array('respuesta.idReactivo = reactivo.idReactivo
					AND aplicacion.codigo =' => $codigo,'reactivo.comentario =' => $serie,
					'reactivo.indice = ' => $pregunta))->
					get('reactivo,respuesta,aplicacion')->
					result();
			return $d;
		}
		public function verSeleccion($codigo,$serie,$pregunta){
			$d = $this->db->select('aplicacion_terman.respuesta')->
                    where(array('reactivo.idReactivo = aplicacion_terman.idReactivo
					AND aplicacion.codigo =' => $codigo,'reactivo.comentario =' => $serie,
					'reactivo.indice = ' => $pregunta))->
					get('reactivo,aplicacion,aplicacion_terman')->
					result_array();
					$indice = $d[0]['respuesta'];
			return $indice;
		}
		public function verCodigoSesion($codigo){
			$p = $this->db->select('idEncuesta,codigo,idAplicacion,finSesion,pregunta')->
					where(array('codigo =' => $codigo))->
					get('aplicacion')->
					result_array();
			return $p;
        }
		public function actualizarPreguntaSesion($codigo,$contador){
			$data = array( 'acabo' => $contador );
			$this->db->where('codigo', $codigo);
			$this->db->update('aplicacion', $data);
		}
		public function guardarFinSesion($codigo,$finSesion){
			$data = array(
				'finSesion' => strval($finSesion)
			 );
			$this->db->where('codigo', $codigo);
			$this->db->update('aplicacion', $data);
		}
		public function insertarRespuesta($idReactivo,$idAplicacion,$respuesta){
			$this->db->query("INSERT INTO aplicacion_terman VALUES($idReactivo,$idAplicacion,$respuesta)
					ON DUPLICATE KEY UPDATE respuesta = $respuesta;");
		}
		public function actualizarPregunta($pregunta,$idAplicacion){
			$this->db->query("UPDATE aplicacion SET pregunta = $pregunta WHERE idAplicacion = $idAplicacion;");
		}
		public function estadoFecha($idAplicacion){
			$data = array(
				'fechaConclusion' => date('Y-m-d'),
				'estado' => 'Finalizado',
				'finSesion' => NULL
			 );
			$this->db->where('idAplicacion', $idAplicacion);
			$this->db->update('aplicacion', $data);	
		}
		//guardar pregunta individual 
		public function obtenerPreguntaTerma($codigo,$serie,$index){
			$d = $this->db->select('reactivo.idReactivo, reactivo.reactivo, reactivo.indice AS indiceR')->
                    where(array('reactivo.indice = ' .$index .' 
					AND aplicacion.codigo =' => $codigo,'reactivo.comentario =' => $serie))->
					get('reactivo,aplicacion')->
					result();
			return $d;
		}
		public function verRespuesta($codigo,$serie,$pregunta){
			$l = $this->db->select('hoja_respuestas.respuesta AS correcto,aplicacion_terman.respuesta')->
					where(array('aplicacion_terman.idReactivo = reactivo.idReactivo AND
					aplicacion.idAplicacion = aplicacion_terman.idAplicacion AND
					hoja_respuestas.serie = reactivo.comentario AND reactivo.indice = hoja_respuestas.numero_pregunta
					AND reactivo.comentario =' => $serie, 'reactivo.indice =' => $pregunta,
					'aplicacion.codigo = ' => $codigo))->
					get('hoja_respuestas,aplicacion_terman,reactivo,aplicacion')->
					result();
			/* $respuesta = $l[0]['respuesta']; */
			return $l;
		}
    }
?>