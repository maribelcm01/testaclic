<?php
    class Dashboard_model extends CI_Model{
		
		function __construct(){
			$this->load->database();
        }

        public function aplicaciones(){
            $q = $this->db->select('persona.nombre AS nombreP,encuesta.nombre AS nombreE,aplicacion.fechaConclusion')->
                    where('encuesta.idEncuesta = aplicacion.idEncuesta AND
                    persona.idPersona = aplicacion.idPersona AND
                    aplicacion.estado = "Finalizado" ORDER by fechaConclusion DESC LIMIT 5')->
					get('aplicacion,encuesta,persona')->
					result_array();
			return $q;
        }
        public function personas(){
            $q = $this->db->select('idPersona,nombre')->
                    order_by('idPersona','DESC')->
                    limit(5)->
					get('persona')->
					result_array();
			return $q;
        }
    }
?>

<!-- SELECT * FROM `aplicacion` where estado = 'Finalizado' ORDER by fechaConclusion DESC LIMIT 5 -->
<!-- SELECT persona.nombre,encuesta.nombre,aplicacion.fechaConclusion
FROM aplicacion,encuesta,persona
WHERE encuesta.idEncuesta = aplicacion.idEncuesta AND persona.idPersona = aplicacion.idPersona
AND aplicacion.estado = 'Finalizado' ORDER by fechaConclusion DESC LIMIT 5 -->