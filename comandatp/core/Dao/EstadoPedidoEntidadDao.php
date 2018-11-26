<?php
namespace Core\Dao;


use Core\Entidad;
use Core\EstadoPedido;
use Core\Exceptions\SysNotImplementedException;

class EstadoPedidoEntidadDao extends EntidadDao
{

    const DEFAULT_ID = 1;

    /** @var int $id */
    public  $id ;
    /** @var string $nombre */
    public $nombre;


    public static function getDefault()
    {
        $estado =  EstadoPedidoEntidadDao::traerUno(EstadoPedidoEntidadDao::DEFAULT_ID);
        if(!$estado)
        {
            throw  new SysException('No existe el estado del pedido definido como default');
        }
        return $estado;
    }

    public static function insertar(Entidad $entidad)
    {
        throw new SysNotImplementedException();// insertar() method.
    }

    public static function actualizar(Entidad $entidad)
    {
        throw new SysNotImplementedException();// actualizar() method.
    }

    public static function eliminar(Entidad $entidad)
    {
        throw new SysNotImplementedException();// eliminar() method.
    }

    static function traerTodos()
    {
        throw new SysNotImplementedException();// traerTodos() method.
    }

    static function traerUno($id)
    {
        $query = 'SELECT id, nombre FROM pedidos_estado ';
        return parent::baseTraerUno(EstadoPedidoEntidadDao::class,$id,$query);
    }

    public function getEntidad()
    {
        return new EstadoPedido($this->id, $this->nombre);
    }


}