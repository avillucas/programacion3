<?php
namespace Core\Api;


use Core\Dao\UsuarioEntidadDao;
use Slim\Http\Request;
use Slim\Http\UploadedFile;

class PreparadorApi extends ApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $data = $this->getParams($request);
        $usuario = UsuarioEntidadDao::crearPreparador($data['nombre'],$data['email'],$data['clave'],$data['sector_id']);
        return $response->withJson(ApiUsable::RESPUESTA_CREADO,200);
    }

    public function TraerUno($request, $response, $args)
    {
        // TODO: Implement TraerUno() method.
    }

    public function TraerTodos($request, $response, $args)
    {
        // TODO: Implement TraerTodos() method.
    }

    public function BorrarUno($request, $response, $args)
    {
        // TODO: Implement BorrarUno() method.
    }

    public function ModificarUno($request, $response, $args)
    {
        // TODO: Implement ModificarUno() method.
    }


}