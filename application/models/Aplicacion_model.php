<?php
    class Aplicacion_model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function guardar($idEncuesta, $idPersona, $id=null){
            $data = array(
               'idEncuesta' => $idEncuesta,
               'idPersona' => $idPersona,
               'codigo' => bin2hex(random_bytes(7)),
               'fechaCreacion' => date('Y-m-d'),
               'estado' => 'Pendiente',
               'pregunta' => intval(1),
               'finSesion' => NULL,
               'acabo' => intval(0),
               'serie' => 'I'
            );
            if($id){
               $this->db->where('idAplicacion', $id);
               $this->db->update('aplicacion', $data);
            }else{
               $this->db->insert('aplicacion', $data);
            } 
        }
  
        public function obtener_por_id($id){
            $this->db->select('idAplicacion, idEncuesta, idPersona, codigo,
                        fechaConclusion, fechaCreacion, estado, pregunta');
            $this->db->from('aplicacion');
            $this->db->where('idAplicacion', $id);
            $consulta = $this->db->get();
            $resultado = $consulta->row();
            return $resultado;
        }
  
        public function obtener_todos(){
            $this->db->select('encuesta.nombre as nomEncuesta, persona.nombre as nomPersona,
                        aplicacion.idAplicacion, aplicacion.idEncuesta, aplicacion.idPersona,
                        aplicacion.codigo, aplicacion.fechaConclusion, aplicacion.fechaCreacion,
                        aplicacion.estado');
            $this->db->from('encuesta,persona,aplicacion');
            $this->db->where('aplicacion.idEncuesta = encuesta.idEncuesta AND
                persona.idPersona = aplicacion.idPersona');  

            //$this->db->order_by('prioridad, titulo', 'asc');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        }

        public function obtenerIdEncuesta(){
            //buscamos los candidatos que no estan aplicando en esa encuesta
            $this->db->select('*');
            $this->db->from('encuesta');
    
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
         }

        public function obtenerIdPersona(){
            //buscamos los candidatos que no estan aplicando en esa encuesta
            $this->db->select('*');
            $this->db->from('persona');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        }

        /* public function eliminar($id){
            $this->db->where('idAplicacion', $id);
            $this->db->delete('aplicacion');
        } */
    }
?>