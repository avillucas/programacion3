<?php
/**
 * Created by PhpStorm.
 * User: Lucas-notebook
 * Date: 29/10/2018
 * Time: 9:51 PM
 */

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
       return $response->withJson(Langs::getCreadoText(),200);
    }

    public function borrarUno($request, $response, $args)
    {
        $id = intval($args['id']);
        Usuario::borrar($id);
        return $response->withJson(Langs::getEliminadoText(),200);
    }

    public function modificarUno($request, $response, $args)
    {
      $id = intval($args['id']);
      $data = $this->getParams($request);
      Usuario::modificar($id,$data);
      return $response->withJson(Langs::getModificadoText(),200);
    }

    /**
     * @param $email
     * @param $password
     * @param $perfil
     * @return string
     * @throws SysValidationException
     */
    public function login($request, $response, $args)
    {
        $email = $this->getParam($request,'email');
        $password = $this->getParam($request,'password');
        $perfil = $this->getParam($request,'perfil');
        $usuario = Usuario::login($email, $password, $perfil);
        //TOKEN
        $data = $usuario->__toArray();
        $data['isAdmin'] = boolval($usuario->perfil==UsuarioPerfiles::SOCIO);
        $token = AutentificadorJWT::CrearToken($data);
        return $response->withJson(['token'=>$token],200);
    }



}