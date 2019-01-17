<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base_model extends CI_Model{

    /**
     * Función básica para insertar en tablas con TimeStamp
     *
     * @param      string  $tabla  The tabla
     * @param      array  $data   The data
     *
     * @return     int  ID generado al momento de la inserción
     */
    public function onlyInsert($tabla, $data)
    {
        $this->timeStamp($tabla);
        $this->db->insert($tabla, $data);
        return $this->db->insert_id();
    }

    /**
     * Select from a table
     *
     * @param      string  $tabla  The tabla
     * @param      array  $where  The where
     *
     * @return     object  Collections or records
     */
    public function onlyGet($tabla, $where=NULL)
    {
        if ($where!=NULL) {
            $query = $this->db->get_where($tabla,$where);
        } else {
            $query = $this->db->get($tabla);
        }
        return ($query->num_rows() != 0 ? $query->result() : FALSE);
    }
        /**
     * { function_description }
     *
     * @param      <type>  $tabla  The tabla
     * @param      <type>  $where  The where
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function onlyGetRow($tabla, $where=NULL)
    {
        return $this->db->get_where($tabla,$where)->row();
    }

    public function getCalificaciones($id_alumno)
    {
        return $this->db->select('t_alumnos.id,t_alumnos.nombre,t_alumnos.ap_paterno,t_materias.nombre as materia,t_calificaciones.calificacion,t_calificaciones.created_at')
        ->from('t_materias')
        ->join('t_calificaciones', 't_materias.id = t_calificaciones.id_t_materias')
        ->join('t_alumnos', 't_alumnos.id = t_calificaciones.id_t_alumno')
        ->where('t_alumnos.id',$id_alumno)
        ->get()
        ->result();
    }

    /**
     * { function_description }
     *
     * @param      <type>  $tabla  The tabla
     * @param      <type>  $data   The data
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function onlyUpdate($tabla, $data)
    {
        $this->timeStamp($tabla,FALSE);
        $this->db->where($data['where']);
        $this->db->update($tabla, $data['info']);
        return $this->db->affected_rows();
    }

    /**
     * Elimina registros de una tabla
     *
     * @param      <type>  $tabla  The tabla
     * @param      <type>  $where  The where
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function onlyDelete($tabla, $where)
    {
        return $this->db->delete($tabla, $where);
    }

    /**
     * { function_description }
     *
     * @param      <type>  $table  The table
     * @param      <type>  $crea   The crea
     */
    public function timeStamp($table,$crea=TRUE)
    {
        if ($crea==TRUE) {
            if ($this->db->field_exists('created_at', $table)) {
                $this->db->set('created_at', 'NOW()', FALSE);
            }
        }
        if ($this->db->field_exists('updated_at', $table)) {
            $this->db->set('updated_at', 'NOW()', FALSE);
        }
    }
}