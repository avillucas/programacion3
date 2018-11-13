<?php

namespace Core\Dao;


use Core\Compra;
use Core\Entidad;
use Core\Exceptions\SysNotImplementedException;

class CompraDao extends Dao
{
    public static function insertar(Entidad $entidad)
    {
        /** @var Compra $entidad */
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOStatement $consulta */
        $consulta =$objetoAccesoDato->RetornarConsulta("
            INSERT INTO compras (fecha,marca,modelo,precio,usuario_id)
            VALUES (:fecha,:marca,:modelo,:precio,:usuario_id)
        ");
        $consulta->bindValue(':fecha',$entidad->getFecha(), \PDO::PARAM_STR);
        $consulta->bindValue(':marca', $entidad->getMarca(), \PDO::PARAM_STR);
        $consulta->bindValue(':modelo', $entidad->getModelo(), \PDO::PARAM_STR);
        $consulta->bindValue(':precio', $entidad->getPrecio(), \PDO::PARAM_STR);
        $consulta->bindValue(':usuario_id', $entidad->getUsuarioId(), \PDO::PARAM_INT);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function actualizar(Entidad $entidad)
    {
        /** @var Compra $entidad */
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOStatement $consulta */
        $consulta =$objetoAccesoDato->RetornarConsulta("
            UPDATE compras  SET 
             fecha = :fecha,
             marca = :marca,
             modelo = :modelo,
             precio = :precio,
             usuario_id = :usuario_id,
             imagen = :imagen
            WHERE id = :id
        ");
        $consulta->bindValue(':fecha',$entidad->getFecha(), \PDO::PARAM_STR);
        $consulta->bindValue(':marca', $entidad->getMarca(), \PDO::PARAM_STR);
        $consulta->bindValue(':modelo', $entidad->getMarca(), \PDO::PARAM_STR);
        $consulta->bindValue(':precio', $entidad->getPrecio(), \PDO::PARAM_STR);
        $consulta->bindValue(':usuario_id', $entidad->getUsuarioId(), \PDO::PARAM_INT);
        $consulta->bindValue(':imagen', $entidad->getImagen(), \PDO::PARAM_STR);
        $consulta->bindValue(':id',$entidad->getId(), \PDO::PARAM_INT);
        return $consulta->execute();
    }

    public static function eliminar(Entidad $entidad)
    {
        throw  new SysNotImplementedException();
    }

    public static function traerTodos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(" SELECT  c.id, c.fecha , c.marca, c.modelo, c.precio, u.email ,u.id AS usuarioId , c.imagen
                FROM  compras AS c
                JOIN usuarios AS u ON c.usuario_id = u.id");
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS, Compra::class);
    }

    public static function traerModelosPorMarca($marca)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(" 
            SELECT   c.modelo
            FROM  compras AS c
            WHERE c.marca = :marca
            GROUP BY modelo
            ");
        $consulta->bindValue(':marca', $marca, \PDO::PARAM_STR);
        $consulta->execute();
        return  $consulta->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function traerProductos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(" 
            SELECT   c.marca, c.modelo 
            FROM  compras AS c
            GROUP BY modelo , marca
            ");
        $consulta->execute();
        return  $consulta->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function traerTodosParaElUsuario($usuarioId)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
            " SELECT  id, fecha , marca, modelo, precio, usuario_id AS usuarioId, imagen
                FROM  compras
                WHERE usuario_id = :usuario_id"
        );
        $consulta->bindValue(':usuario_id', $usuarioId, \PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS, Compra::class);
    }

    public static function traerUno($id)
    {
       throw  new SysNotImplementedException();
    }

}