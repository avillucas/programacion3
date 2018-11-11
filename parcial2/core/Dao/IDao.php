<?php
namespace Core\Dao;


use Core\Entidad;
use Core\Exceptions\SysNotFoundException;

abstract  class IDao
{

    /**
     * Guarda el usuario en la base de datos
     * @return string
     */
    abstract  protected function insertar();

    /**
     * Actualiza el usuario en la base de datos
     * @return bool
     */
    abstract protected function actualizar();

    /**
     * Elimina de la base la entidad
     * @return bool
     */
    abstract protected function eliminar();

    /**
     * @param $id de la entidad a eliminar
     * @throws SysNotFoundException
     * @return void
     */
    public static function traerOFallar($id)
    {
        $entidad = static::traerUno($id);
        if(!$entidad)
        {
            throw new SysNotFoundException('No existe el recurso buscado');
        }
        return $entidad;
    }

    /**
     * Retorna una lista de todas las entidades
     * @return Entidad[]
     */
    abstract static function traerTodos();

    /**
     * Retorna una entidad en base al id enviado
     * @param $id
     * @return Entidad
     */
    abstract static function traerUno($id);
}