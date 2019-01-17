<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class MY_Controller extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        // do some stuff
    }
}

class MY_Api extends MY_Controller {

    /**
     * function construct
     */
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');

        setlocale(LC_TIME, 'es_ES');
    }

    /**
      * funcion para generar codigo de activacion
      *
      * @return     string  code
      */
     protected function generateCode()
    {
        $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $cadena_base .= '0123456789' ;
        $password = '';
        $largo=40;
        $limite = strlen($cadena_base) - 1;
        for ($i=0; $i < $largo; $i++)
        $password .= $cadena_base[rand(0, $limite)];
        return $password;
    }

}