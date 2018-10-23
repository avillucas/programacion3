<?php
namespace Core\Api;
use Core\Core\Usuario;

class UsuarioApi implements IApiUsable
{
    public function TraerUno($request, $response, $args){}
    public function TraerTodos($request, $response, $args){}
    
    public function CargarUno($request, $response, $args)
    {
        die('asdsd');
        var_dump($args);exit;
        //$usuario = Usuario::crear($_POST);        
    }
    public function BorrarUno($request, $response, $args){}
    public function ModificarUno($request, $response, $args){}
}