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
use Core\Usuario;

class UsuarioApi extends IApiUsable
{
    public function TraerUno($request, $response, $args)
    {
        $id= intval($args['id']);
        $el= Usuario::traerOFallar($id);
        return $response->withJson($el, 200);
    }

    public function TraerTodos($request, $response, $args)
    {
        $usuarios= Usuario::traerTodos();
        return $response->withJson($usuarios, 200);
    }

    public function CargarUno($request, $response, $args)
    {
       $data = $this->getParams($request);
       Usuario::crear($data);
       return $response->withJson(Langs::getCreadoText(),200);
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = intval($args['id']);
        Usuario::borrar($id);
        return $response->withJson(Langs::getEliminadoText(),200);
    }

    public function ModificarUno($request, $response, $args)
    {
      $id = intval($args['id']);
      Usuario::modificar($id,$args);
      return $response->withJson(Langs::getModificadoText(),200);
    }

    /**
     * @param $email
     * @param $password
     * @param $perfil
     * @return string
     * @throws SysValidationException
     */
    public static function login($email, $password, $perfil)
    {
        $usuario = Usuario::login($email, $password, $perfil);
        //TOKEN
        $token = AutentificadorJWT::CrearToken($usuario->__toArray());
        return $token;
    }


}