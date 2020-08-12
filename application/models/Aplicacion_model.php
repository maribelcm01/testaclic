<?php
    class Aplicacion_model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function guardar($idEncuesta, $idEncuestado, $id=null){
            $data = array(
               'idEncuesta' => $idEncuesta,
               'idEncuestado' => $idEncuestado,
               'codigo' => bin2hex(random_bytes(7)),
               'fechaCreacion' => date('Y-m-d'),
               'estado' => 'Pendiente',
               'pregunta' => intval(1),
               'sesion' => intval(0),
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
            $this->db->select('idAplicacion, idEncuesta, idEncuestado, codigo,
                        fechaConclusion, fechaCreacion, estado, pregunta');
            $this->db->from('aplicacion');
            $this->db->where('idAplicacion', $id);
            $consulta = $this->db->get();
            $resultado = $consulta->row();
            return $resultado;
        }
  
        public function obtener_todos(){
            $this->db->select('encuesta.nombre as nomEncuesta, encuestado.nombre as nomEncuestado,
                        aplicacion.idAplicacion, aplicacion.idEncuesta, aplicacion.idEncuestado,
                        aplicacion.codigo, aplicacion.fechaConclusion, aplicacion.fechaCreacion,
                        aplicacion.estado');
            $this->db->from('encuesta,encuestado,aplicacion');
            $this->db->where('aplicacion.idEncuesta = encuesta.idEncuesta AND
                encuestado.idEncuestado = aplicacion.idEncuestado');  

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

        public function obtenerIdEncuestado(){
            //buscamos los candidatos que no estan aplicando en esa encuesta
            $this->db->select('*');
            $this->db->from('encuestado');
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