<?php
namespace Core\Dao;


use Core\Entidad;
use Core\Preparador;

class PreparadorEntidadDao extends  EntidadDao
{
    /** @var int $empleado_id */
    public  $empleado_id ;
    /** @var int $sector_id */
    public  $sector_id ;

    public static function insertar(Entidad $entidad)
    {
        /** @var Preparador $preparador */
        $preparador = &$entidad;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOStatement $consulta */
        $consulta = $objetoAccesoDato->RetornarConsulta("
            INSERT INTO preparadores (empleado_id,sector_id)
            VALUES (:empleado_id,:sector_id)
        ");
        $consulta->bindValue(':empleado_id', $preparador->getEmpleado()->getId(), \PDO::PARAM_INT);
        $consulta->bindValue(':sector_id', $preparador->getSector()->getId(), \PDO::PARAM_INT);
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
        throw new SysNotImplementedException();// traerUno() method.
    }

    public function getEntidad()
    {
        $empleado = EmpleadoEntidadDao::traerUno($this->empleado_id);
        $sector = SectorEntidadDao::traerUno($this->sector_id);
        return new Preparador($this->id,$empleado,$sector);
    }

}