<?php
namespace Core\Dao;

use Core\Entidad;
use Core\EstadoPedido;
use Core\Exceptions\SysNotImplementedException;
use Core\Pedido;

class PedidoEntidadDao extends EntidadDao
{

    /** @var int $comanda_id */
    public $comanda_id;

    /** @var int $alimento_id */
    public $alimento_id;

    /** @var int $encargado_id */
    public $encargado_id = null;

    /** @var int $cantidad */
    public $cantidad;

    /** @var string $tiempo_estimado */
    public $tiempo_estimado = null ;

    /** @var string $momento_creacion */
    public $momento_creacion ;

    /** @var string $momento_preparacion */
    public $momento_preparacion = null;

    /** @var string $momento_de_entrega */
    public $momento_de_entrega = null;

    /** @var int $estado */
    public $estado_id;

    public static function insertar(Entidad $entidad)
    {
      /** @var Pedido $pedido */
        $pedido = &$entidad;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $sql = "
            INSERT INTO pedidos (                                 
              comanda_id,
              alimento_id, 
              encargado_id , 
              cantidad, 
              tiempo_estimado, 
              momento_creacion,
              momento_preparacion, 
              momento_de_entrega, 
              estado_id
            )
            VALUES (                 
                    :comandaId,
                    :alimentoId,
                    :encargadoId,
                    :cantidad,
                    :tiempoEstimado,
                    :momentoCreacion,
                    :momentoPreparacion,
                    :momentoDeEntrega,
                    :estadoId
            )
        ";
        /** @var \PDOStatement $consulta */
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->bindValue(':comandaId', $pedido->getComanda()->getId(), \PDO::PARAM_INT);
        $consulta->bindValue(':alimentoId', $pedido->getAlimento()->getId(), \PDO::PARAM_INT);
        $consulta->bindValue(':cantidad', $pedido->getCantidad(), \PDO::PARAM_INT);
        $consulta->bindValue(':estadoId', $pedido->getEstado()->getId(), \PDO::PARAM_INT);
        if(!empty($pedido->getTiempoEstimado())){
            $consulta->bindValue(':tiempoEstimado', $pedido->getTiempoEstimado(), \PDO::PARAM_INT);
        }else{
            $consulta->bindValue(':tiempoEstimado', null,\PDO::PARAM_NULL);
        }
        if(!empty($pedido->getEncargado())){
            $consulta->bindValue(':encargadoId', $pedido->getEncargado()->getId(), \PDO::PARAM_INT);
        }else{
            $consulta->bindValue(':encargadoId', null,\PDO::PARAM_NULL);
        }
        if(!empty($pedido->getMomentoCreacion())){
            $consulta->bindValue(':momentoCreacion', $pedido->getMomentoCreacion(), \PDO::PARAM_STR);
        }else{
            $consulta->bindValue(':momentoCreacion', null,\PDO::PARAM_NULL);
        }
        if(!empty($pedido->getMomentoPreparacionInicio())){
            $consulta->bindValue(':momentoPreparacion', $pedido->getMomentoPreparacionInicio(), \PDO::PARAM_STR);
        }else{
            $consulta->bindValue(':momentoPreparacion', null,\PDO::PARAM_NULL);
        }
        if(!empty($pedido->getMomentoDeEntrega())){
            $consulta->bindValue(':momentoDeEntrega', $pedido->getMomentoDeEntrega(), \PDO::PARAM_STR);
        }else{
            $consulta->bindValue(':momentoDeEntrega', null,\PDO::PARAM_NULL);
        }



        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function actualizar(Entidad $entidad)
    {
        throw new SysNotImplementedException();// actualizar() method.
    }

    public static function eliminar(Entidad $entidad)
    {
        throw new SysNotImplementedException();// eliminar() method.
    }

    public static function  trearPorComanda($comandaId)
    {
        $query =  'SELECT  alimento_id, encargado_id,  cantidad, tiempo_estimado, momento_creacion, momento_preparacion, momento_de_entrega, estado_id, comanda_idalimento_id, encargado_id,  cantidad, tiempo_estimado, momento_creacion, momento_preparacion, momento_de_entrega, estado_id, comanda_id   FROM pedidos WHERE comanda_id = :comandaId';
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->bindValue(':comandaId', $comandaId, \PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS,PedidoEntidadDao::class);
    }

    static function traerTodos()
    {

        $query =  'SELECT  alimento_id, encargado_id,  cantidad, tiempo_estimado, momento_creacion, momento_preparacion, momento_de_entrega, estado_id, comanda_idalimento_id, encargado_id,  cantidad, tiempo_estimado, momento_creacion, momento_preparacion, momento_de_entrega, estado_id, comanda_id   FROM pedidos ';
        return parent::baseTraerTodos(PedidoEntidadDao::class,$query);
    }

    static function traerUno($id)
    {
        $query =  'SELECT  alimento_id, encargado_id,  cantidad, tiempo_estimado, momento_creacion, momento_preparacion, momento_de_entrega, estado_id, comanda_idalimento_id, encargado_id,  cantidad, tiempo_estimado, momento_creacion, momento_preparacion, momento_de_entrega, estado_id, comanda_id   FROM pedidos ';
        return parent::baseTraerUno(PedidoEntidadDao::class,$id,$query);
    }

    public function getEntidad()
    {
        $comanda = ComandaEntidadDao::traerUno($this->comanda_id);
        $alimento = AlimentoEntidadDao::traerUno($this->alimento_id);
        $encargado = (isset($this->encargado_id)) ?  PreparadorEntidadDao::traerUno($this->encargado_id):null;
        $momentoCreacion = new \DateTime($this->momento_creacion);
        $momentoEntrega = (isset($this->momento_de_entrega)) ? new \DateTime($this->momento_de_entrega):null;
        $momentoPreparacion =(isset($this->momento_preparacion)) ?  new \DateTime($this->momento_preparacion):null;
        $estado = (isset($this->estado_id)) ? EstadoPedidoEntidadDao::traerUno($this->estado_id):null;
        $pedido = new Pedido($comanda,$alimento,$encargado,$this->cantidad,$this->tiempo_estimado,$momentoCreacion,$momentoPreparacion,$momentoEntrega,$estado);
        return $pedido;
    }


}