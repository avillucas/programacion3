<?php
/**
 * Created by PhpStorm.
 * User: Lucas-notebook
 * Date: 10/11/2018
 * Time: 8:59 PM
 */

namespace Core\Dao;


class RegistroPeticionesDao
{

    public static function crear($usuarioId,$metodo,$ruta)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
            INSERT INTO registro_peticiones (usuario_id,metodo,ruta)
            VALUES (:usuarioId,:metodo,:ruta)
        ");
        $consulta->bindValue(':usuarioId', $usuarioId, \PDO::PARAM_INT);
        $consulta->bindValue(':metodo', $metodo, \PDO::PARAM_STR);
        $consulta->bindValue(':ruta',$ruta, \PDO::PARAM_STR);
        $consulta->execute();
        return  $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
}