<?php
namespace Core\Dao;

use Core\Empleado;
use Core\Entidad;
use Core\Mozo;

class MozoEntidadDao extends  EntidadDao
{
    /** @var Empleado $empleado */
    public $empleado_id;

    /**
     * @param Entidad $entidad
     * @return \Core\Empleado
     */
    public static function insertar(Entidad $entidad)
    {
        /** @var Mozo $mozo */
        $mozo = &$entidad;
        /** @var Usuario $entidad */
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOStatement $consulta */
        $consulta = $objetoAccesoDato->RetornarConsulta("
            INSERT INTO mozos (empleado_id)
            VALUES (:empleado_id)
        ");
        $consulta->bindValue(':empleado_id', $mozo->getEmpleado()->getId(), \PDO::PARAM_INT);
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
        return new Mozo($this->id,$empleado);
    }


}