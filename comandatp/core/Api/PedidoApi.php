<?php
namespace Core\Api;


use Core\Dao\AlimentoEntidadDao;
use Core\Dao\ComandaEntidadDao;
use Core\Dao\EstadoPedidoEntidadDao;
use Core\Dao\PedidoEntidadDao;
use Core\Dao\PreparadorEntidadDao;
use Core\Exceptions\SysNotImplementedException;
use Core\Exceptions\SysValidationException;
use Core\Pedido;
use Slim\Http\Request;
use Slim\Http\UploadedFile;

class PedidoApi extends ApiUsable
{

    public function preparar($request, $response, $args)
    {
        $data = $this->getParams($request);
        $payload = $this->getPayloadActual($request);
        $preparador = PreparadorEntidadDao::traerUnoPorEmpleadoId($payload->empledo_id);
        //
        /** @var Pedido $pedido */
        $pedido = PedidoEntidadDao::traerUno($data['pedido_id']);
        //
        if(!$pedido->isPendiente())
        {
            throw new SysValidationException("El pedido no se encuentra pendiente , por lo tanto no puede ser preparado");
        }

        $pedido->setEncargado($preparador);
        $pedido->setTiempoEstimado($data['tiempo_estimado']);
        $pedido->setMomentoPreparacionInicio(new \DateTime());
        $pedido->setEstado(EstadoPedidoEntidadDao::traerEnPreparacion());

        PedidoEntidadDao::save($pedido);
        //
        return $response->withJson([
            'response' => 'El pedido esta siendo preparado , pertenece a la comanda '.$pedido->getComanda()->getCodigo(),
            'data' => ['tiempoEstimado'=>  $pedido->getTiempoEstimado()],
        ],200);
    }

    public function CargarUno($request, $response, $args)
    {
        $data = $this->getParams($request);
        $comanda = ComandaEntidadDao::traerUno($data['comanda_id']);
        $alimento = AlimentoEntidadDao::traerUno($data['alimento_id']);
        $pedido = new Pedido(null,$comanda,$alimento,null,intval($data['cantidad']));
        PedidoEntidadDao::save($pedido);
        return $response->withJson([
            'response' => 'Pedido cargado en la comnada , codigo : '.$comanda->getCodigo(),
            'data' => ['comandaCodigo'=>  $comanda->getCodigo()],
        ],200);
    }

    public function TraerUno($request, $response, $args)
    {
        $pedido = PedidoEntidadDao::traerUno($args['id']);
        return $response->withJson($pedido->__toArray(), 200);;
    }

    public function TraerTodos($request, $response, $args)
    {
        $todos = PedidoEntidadDao::traerTodosConRelaciones();
        return $response->withJson($todos, 200);
    }

    public function BorrarUno($request, $response, $args)
    {
        throw  new SysNotImplementedException();
    }

    public function ModificarUno($request, $response, $args)
    {
        // TODO: Implement ModificarUno() method.
    }

}