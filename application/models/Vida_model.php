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
					where(array('encuestado.idEncuestado = aplicacion.idEncuestado AND aplicacion.codigo =' => $codigo))->
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

		public function verIdEncuesta($codigo){
			$p = $this->db->select('idEncuesta')->
					where(array('codigo =' => $codigo))->
					get('aplicacion')->
					result_array();
			$idEncuesta = $p[0]['idEncuesta'];
			return $idEncuesta;
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
			$q = $this->db->select('encuestado.nombre, reactivo.idReactivo, reactivo.reactivo, reactivo.comentario, reactivo.indice, aplicacion.codigo')->
					where(array('aplicacion.idEncuestado = encuestado.idEncuestado AND 
					aplicacion.codigo =' => $codigo, 'reactivo.idReactivo =' => $idReactivo))->
					get('reactivo,aplicacion,encuestado')->
					row();
			return $q;
		}


		public function verDatosBack($codigo,$idReactivo,$back,$idEncuesta){
			$q = $this->db->select('encuestado.nombre, reactivo.idReactivo, reactivo.reactivo, reactivo.comentario, reactivo.indice,aplicaciondetalle.valor ,aplicacion.codigo')->
			where(array('aplicacion.idEncuestado = encuestado.idEncuestado AND 
					aplicaciondetalle.idAplicacion = aplicacion.idAplicacion AND 
					aplicaciondetalle.idReactivo = reactivo.idReactivo AND
					aplicacion.codigo =' => $codigo, 'reactivo.indice =' => $back, 'aplicaciondetalle.idReactivo =' => $idReactivo))->
					get('reactivo,aplicacion,encuestado,aplicaciondetalle')->
					row();
			return $q;
		}
		
		public function registrarAplicacionDetalle($idAplicacion,$idReactivo,$valor){
			$this->db->query("INSERT INTO aplicaciondetalle VALUES($idAplicacion,$idReactivo,$valor)
					ON DUPLICATE KEY UPDATE valor = $valor;");
		}

		public function ultimaRegistrada($pregunta,$idAplicacion,$idEncuesta){
			$this->db->query("UPDATE aplicacion SET pregunta = $pregunta WHERE idAplicacion = $idAplicacion;");
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

		public function estadoFecha($idAplicacion){
			$data = array(
				'fechaConclusion' => date('Y-m-d'),
				'estado' => 'Finalizado'
			 );
			$this->db->where('idAplicacion', $idAplicacion);
			$this->db->update('aplicacion', $data);	
		}

		/*public function busca_pregunta_control($codigo){
			$p = $this->db->select('aplicacion.pregunta')->
					where(array('aplicacion.idEncuesta = encuesta.idEncuesta AND
							aplicacion.codigo =' => $codigo))->
					get('aplicacion, encuesta')->
					row();
			$pregunta = $p;
			return $pregunta;
		}*/
		/*public function total_de_preguntas_reactivo($idEncuesta){
			$this->db->select('*');
			$this->db->from('reactivo');
			$this->db->where('idEncuesta',$idEncuesta);
			$query = $this->db->get();
			$contador_de_preguntas_reactivo =  $query->num_rows();

			return $contador_de_preguntas_reactivo;
		}*/

	}
 ?>