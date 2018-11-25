<?php
/**
 * Created by PhpStorm.
 * User: Lucas-notebook
 * Date: 25/11/2018
 * Time: 6:25 PM
 */

namespace Core\Dao;


use Core\Entidad;
use Core\Exceptions\SysNotImplementedException;
use Core\Mesa;

class MesaEntidadDao extends  EntidadDao
{

    /** @var string $codigo */
    public $codigo ;

    /** @var EstadoMesa  */
    public $estado_id;

    public static function insertar(Entidad $entidad)
    {
        /** @var Mesa $mesa */
        $mesa = &$entidad;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOStatement $consulta */
        $consulta = $objetoAccesoDato->RetornarConsulta("
            INSERT INTO mesas (codigo,estado_id)
            VALUES (:codigo,:estado_id)
        ");
        $consulta->bindValue(':codigo', $mesa->getCodigo(), \PDO::PARAM_STR);
        $consulta->bindValue(':estado_id', $mesa->getEstado()->getId(), \PDO::PARAM_INT);
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

    static function traerTodos()
    {
        throw new SysNotImplementedException();// traerTodos() method.
    }

    static function traerUno($id)
    {
       $query  = 'SELECT id, codigo , estado_id FROM mesas ';
       return parent::baseTraerUno(MesaEntidadDao::class,$id,$query);
    }

    public function getEntidad()
    {
        $estado = (isset($this->estado_id)) ? EstadoMesaEntidadDao::traerUno($this->estado_id):null;
        return new Mesa($this->id, $estado);
    }


}