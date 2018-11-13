<?php
namespace Core\Api;

use Core\IO\IO;
use Core\Middleware\AutentificadorJWT;
use Core\Usuario;
use Slim\Http\Request;
use Slim\Http\UploadedFile;

abstract class IApiUsable{

    const RESPUESTA_CREADO = 'creado correctamente';

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
        $usuario =  new Usuario($data->id,$data->email,null,$data->perfil);
        $usuario->setClaveEncriptada($data->clave);
        return $usuario;
    }

    /**
     * @param Request $request
     * @param $varName
     * @return UploadedFile
     * @throws \Exception
     */
    protected function traerUnArchivo(Request $request, $variable,$requerido= false)
    {
        $files = $request->getUploadedFiles();
        if($requerido && !isset($files[$variable]))
        {
            throw new \Exception("No fue enviado el archivo ".$variable." en la peticion");
        }
        return $files[$variable];
    }
    abstract public function TraerUno($request, $response, $args);
    abstract public function TraerTodos($request, $response, $args);
    abstract public function CargarUno($request, $response, $args);
    abstract public function BorrarUno($request, $response, $args);
    abstract public function ModificarUno($request, $response, $args);

}