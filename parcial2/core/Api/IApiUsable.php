<?php
namespace Core\Api;

use Core\Middleware\AutentificadorJWT;
use Core\Usuario;
use Slim\Http\Request;

abstract class IApiUsable{

    const RESPUESTA_CREADO = 'creado correctamente';
    const RESPUESTA_MODIFICADO = 'modificado correctamente';
    const RESPUESTA_ELIMINADO = 'eliminado correctamente';


    public function getParams($request)
    {
        return   $request->getParsedBody();
    }

    public function getParam($request,$param,$defaultValue = null)
    {
        $body = $request->getParsedBody();
        if(!isset($body[$param])){
           return ($defaultValue) ?  $defaultValue: null;
        }
        return $body[$param];
    }

    protected function getUsuarioActual(Request $request)
    {
        $data =   AutentificadorJWT::obtenerPayLoadDelRequest($request);
        $usuario =  new Usuario($data->id,$data->nombre,null,$data->sexo,$data->perfil);
        $usuario->setClaveEncriptada($data->clave);
        return $usuario;
    }

   	abstract public function TraerUno($request, $response, $args);
    abstract public function TraerTodos($request, $response, $args);
    abstract public function CargarUno($request, $response, $args);
    abstract public function BorrarUno($request, $response, $args);
    abstract public function ModificarUno($request, $response, $args);

}