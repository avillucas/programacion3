<?php
namespace Core\Api;

use Core\Exceptions\SysValidationException;
use Core\Middleware\AutentificadorJWT;
use Core\Models\Langs;
use Core\Models\UsuarioPerfiles;
use Core\Usuario;

class UsuarioApi extends IApiUsable
{
    public function traerUno($request, $response, $args)
    {
        $id= intval($args['id']);
        $el= Usuario::traerOFallar($id);
        return $response->withJson($el, 200);
    }

    public function traerTodos($request, $response, $args)
    {
        $usuarios= Usuario::traerTodos();
        return $response->withJson($usuarios, 200);
    }

    public function cargarUno($request, $response, $args)
    {
       $data = $this->getParams($request);
       Usuario::crear($data);
       return $response->withJson(IApiUsable::RESPUESTA_CREADO,200);
    }

    public function borrarUno($request, $response, $args)
    {
        $id = intval($args['id']);
        Usuario::borrar($id);
        return $response->withJson(IApiUsable::RESPUESTA_ELIMINADO,200);
    }

    public function modificarUno($request, $response, $args)
    {
      $id = intval($args['id']);
      $data = $this->getParams($request);
      Usuario::modificar($id,$data);
      return $response->withJson(IApiUsable::RESPUESTA_MODIFICADO,200);
    }

    public function login($request, $response, $args)
    {
        $nombre = $this->getParam($request,'nombre');
        $clave = $this->getParam($request,'clave');
        $sexo = $this->getParam($request,'sexo');
        $usuario = Usuario::login($nombre, $clave, $sexo);
        //TOKEN
        $data = $usuario->__toArray();
        $data['isAdmin'] = boolval($usuario->perfil == Usuario::PERFIL_ADMINISTRADOR);
        $token = AutentificadorJWT::crearToken($data);
        return $response->withJson(['token'=>$token],200);
    }

}