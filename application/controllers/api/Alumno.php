<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once APPPATH . 'core/BND_Fueser.php';
/**
* 
*/
date_default_timezone_set("America/Mexico_City");
class Alumno extends MY_Api
{

    protected $msg= [
        'guardarinfo'=>'Ocurrio un error al guardar informacion por favor contacta al administrador'
    ];
    function __construct() {

        parent::__construct();
    }
    public function create_note_post()
    {
        $this->form_validation->set_data($this->post());
        $this->form_validation
        ->set_rules('id_materia','','required|exists[t_materias.id]')
        ->set_rules('id_alumno','','required|exists[t_alumnos.id]')
        ->set_rules('calificacion','','required|numeric');

        if ($this->form_validation->run() == FALSE)
        {
            $this->response(
                [
                    'success'=>false,
                    'msg'=> strip_tags(validation_errors()),
                ],400);
        }
        $data = [
            'id_t_materias' => $this->post('id_materia'),
            'id_t_alumno' => $this->post('id_alumno'),
            'calificacion' => $this->post('calificacion')
        ];
        if ($this->base->onlyInsert('t_calificaciones',$data)) {
            $this->response(
                [
                    'success'=>'ok',
                    'msg'=> 'calificacion registrada',
                ],200);
        }
        $this->response(
            [
                'success'=>false,
                'msg'=> $this->msg['guardarinfo']
            ],400);
    }
    public function get_calificacion_get()
    {

        $this->form_validation->set_data($this->get());
        $this->form_validation
        ->set_rules('id_alumno','','required|exists[t_alumnos.id]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->response(
                [
                    'success'=>false,
                    'msg'=> strip_tags(validation_errors()),
                ],400);
        }
          $data = $this->base->getCalificaciones($this->get('id_alumno'));

        $promedio=0;
        $suma=0;
        $numero=count($data);

        foreach ($data as $id => $valor) {

            $fecharegistro=$valor->created_at;
             $FRdateTime = new DateTime($fecharegistro);
            $newfrdate= date("d/m/Y", $FRdateTime->getTimestamp());
            $valor->created_at=$newfrdate;
            $suma=$suma+$valor->calificacion;

        }
                $promedio= bcdiv($suma/$numero, '1', 1);
            $data['promedio'] = $promedio;
            $this->response(
                [
                    'success'=>'ok',
                    'data'=> $data,
                ],200);

    }
    public function update_note_put()
    {
        $this->form_validation->set_data($this->put());
        $this->form_validation
        ->set_rules('id_calificacion','','required|exists[t_calificaciones.id]')
        ->set_rules('calificacion','','required|numeric');

        if ($this->form_validation->run() == FALSE)
        {
            $this->response(
                [
                    'success'=>false,
                    'msg'=> strip_tags(validation_errors()),
                ],400);
        }
        if ($this->base->onlyUpdate('t_calificaciones',[
            'where'=>[
                'id'=>$this->put('id_calificacion')
            ],
            'info'=>[
                'calificacion'=>$this->put('calificacion')
            ],
        ])) {
            $this->response(
                [
                    'success'=>'ok',
                    'msg'=> 'calificacion actualizada',
                ],200);
        }
        $this->response(
            [
                'success'=>false,
                'msg'=> $this->msg['guardarinfo']
            ],400);
    }
    public function delete_note_delete($id_calificacion)
    {
        $this->form_validation->set_data($this->get());
        $this->form_validation
        ->set_rules('id_calificacion','','required|exists[t_calificaciones.id]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->response(
                [
                    'success'=>false,
                    'msg'=> strip_tags(validation_errors()),
                ],400);
        }

        if ($this->base->onlyDelete('t_calificaciones',
            [
                'id'=>$this->get('id_calificacion')
            ]
        )) {
            $this->response(
                [
                    'success'=>'ok',
                    'msg'=> 'calificacion eliminada',
                ],200);
        }
        $this->response(
            [
                'success'=>false,
                'msg'=> $this->msg['guardarinfo']
            ],400);
    }
}
?>