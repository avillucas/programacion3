<?php
namespace Core\Api;

use Core\Compra;
use Core\Exceptions\SysNotImplementedException;

class CompraApi extends IApiUsable
{
    public function traerUno($request, $response, $args)
    {
        throw  new SysNotImplementedException();
    }

    public function traerTodos($request, $response, $args)
    {
        $usuario = $this->getUsuarioActual($request);
        $compras= ($usuario->isAdmin()) ?  Compra::traerTodos(): Compra::traerTodosParaElUsuario($usuario->getId());
        return $response->withJson($compras, 200);
    }

    public function CargarUno($request, $response, $args)
    {
        $data = $this->getParams($request);
        $data['usuarioId'] = $this->getUsuarioActual($request)->getId();
        Compra::crear($data );
        return $response->withJson(IApiUsable::RESPUESTA_CREADO,200);
    }

    public function BorrarUno($request, $response, $args)
    {
        throw  new SysNotImplementedException();
    }

    public function ModificarUno($request, $response, $args)
    {
        throw  new SysNotImplementedException();
    }


}