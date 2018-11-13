<?php
namespace Core\Api;

use Core\Compra;
use Core\Dao\CompraDao;
use Core\Exceptions\SysNotImplementedException;
use Core\IO\IO;
use Slim\Http\Request;

class CompraApi extends IApiUsable
{
    public function traerUno($request, $response, $args)
    {
        throw  new SysNotImplementedException();
    }

    public function traerTodos($request, $response, $args)
    {
        $usuario = $this->getUsuarioActual($request);
        $compras= ($usuario->isAdmin()) ?  CompraDao::traerTodos(): CompraDao::traerTodosParaElUsuario($usuario->getId());
        return $response->withJson($compras, 200);
    }

    public function traerPorMarca(Request $request, $response, $args)
    {
        $marca = $request->getParam('marca',null);
        $compras = CompraDao::traerModelosPorMarca($marca);
        return $response->withJson($compras, 200);
    }

    public function traerProductos(Request $request, $response, $args)
    {
        $compras = CompraDao::traerProductos();
        return $response->withJson($compras, 200);
    }

    public function CargarUno($request, $response, $args)
    {
        $data = $this->getParams($request);
        $data['usuarioId'] = $this->getUsuarioActual($request)->getId();
        $compra = Compra::crear($data);
        //IMAGEN
        $fileData  = $this->traerUnArchivo($request, 'imagen');
        $nombreImagen = IO::subirArchivo($fileData,Compra::IMAGEN_DIRECTORIO,Compra::generarNombreImagen($compra));
        $compra->setImagen($nombreImagen);
        //
        $compra->save();
        //
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