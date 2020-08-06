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
		public function cambiarEstado($codigo,$estado){
				$data = array('estado' => $estado);
				$this->db->where('codigo',$codigo);
        		$this->db->update('aplicacion',$data);
		}
		public function obtenerPregunta($codigo,$estado){
			$d = $this->db->select('reactivo.idReactivo, reactivo.reactivo, respuesta.respuesta, respuesta.indice,')->
                    where('reactivo.indice = aplicacion.pregunta
					AND respuesta.idReactivo = reactivo.idReactivo AND aplicacion.codigo ='.'\''.$codigo.'\''.
					'AND reactivo.comentario ='.'\''.$estado.'\'')->
					get('reactivo,respuesta,aplicacion')->
					result();
			return $d;
		}
    }
?>