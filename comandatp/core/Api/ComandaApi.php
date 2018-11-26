<?php
namespace Core\Api;

use Core\Comanda;
use Core\Dao\AlimentoEntidadDao;
use Core\Dao\ComandaEntidadDao;
use Core\Dao\MesaEntidadDao;
use Core\Dao\MozoEntidadDao;
use Core\Dao\PedidoEntidadDao;
use Core\Exceptions\SysNotImplementedException;
use Core\Pedido;
use Slim\Http\Request;
use Slim\Http\UploadedFile;

class ComandaApi extends  ApiUsable
{
    public function tomar($request, $response, $args)
    {
        $data = $this->getParams($request);
        $payload = $this->getPayloadActual($request);
        $mozo = MozoEntidadDao::traerUnoPorEmpleadoId($payload->empledo_id);
        $mesa = MesaEntidadDao::traerUnoPorCodigo($data['codigo_mesa']);
        $comanda = new Comanda(null,$mozo,$mesa,$data['nombre_cliente']);
        ComandaEntidadDao::save($comanda);
        foreach($data['pedidos'] as $pedidoRequest)
        {
            $alimento = AlimentoEntidadDao::traerUno($pedidoRequest['alimento_id']);
            $pedido = new Pedido(null,$comanda,$alimento,null,intval($pedidoRequest['cantidad']));
            PedidoEntidadDao::save($pedido);
        }
        return $response->withJson([
            'response' => 'Comanda creada , codigo : '.$comanda->getCodigo(),
            'data' => ['comandaCodigo'=>  $comanda->getCodigo()],
        ],200);
    }

    public function CargarUno($request, $response, $args)
    {
        throw new SysNotImplementedException();// CargarUno() method.
    }

    public function TraerUno($request, $response, $args)
    {
        throw new SysNotImplementedException();// TraerUno() method.
    }

    public function TraerTodos($request, $response, $args)
    {
        throw new SysNotImplementedException();// TraerTodos() method.
    }

    public function BorrarUno($request, $response, $args)
    {
        throw new SysNotImplementedException();// BorrarUno() method.
    }

    public function ModificarUno($request, $response, $args)
    {
        throw new SysNotImplementedException();// ModificarUno() method.
    }


}