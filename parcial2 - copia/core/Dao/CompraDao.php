<?php

namespace Core\Dao;


use Core\Compra;
use Core\Entidad;

class CompraDao extends Dao
{
    public static function insertar(Entidad $entidad)
    {
        /** @var Compra $entidad */
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOStatement $consulta */
        $consulta =$objetoAccesoDato->RetornarConsulta("
            INSERT INTO compras (fecha,articulo,precio,usuario_id)
            VALUES (:fecha,:articulo,:precio,:usuario_id)
        ");
        $consulta->bindValue(':fecha',$entidad->getFecha(), \PDO::PARAM_STR);
        $consulta->bindValue(':articulo', $entidad->getArticulo(), \PDO::PARAM_STR);
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
             articulo = :articulo,
             precio = :precio,
             usuario_id = :usuario_id,
             imagen = :imagen
            WHERE id = :id
        ");
        $consulta->bindValue(':fecha',$entidad->getFecha(), \PDO::PARAM_STR);
        $consulta->bindValue(':articulo', $entidad->getArticulo(), \PDO::PARAM_STR);
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
        $consulta =$objetoAccesoDato->RetornarConsulta(" SELECT  c.id, c.fecha , c.articulo, c.precio, u.nombre ,u.id AS usuarioId , c.imagen
                FROM  compras AS c
                JOIN usuarios AS u ON c.usuario_id = u.id");
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS, Compra::class);
    }

    public static function traerTodosParaElUsuario($usuarioId)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
            " SELECT  id, fecha , articulo, precio, usuario_id AS usuarioId, imagen
                FROM  compras
                WHERE usuario_id = :usuario_id"
        );
        $consulta->bindValue(':usuario_id', $usuarioId, \PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS, Compra::class);
    }

    public static function traerUno($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
            "SELECT id, nombre, clave, sexo, perfil 
                FROM usuarios 
                WHERE id = :id"
        );
        $consulta->bindValue(':id',$id,\PDO::PARAM_INT);
        $consulta->execute();
        $usuario = $consulta->fetchObject(Compra::class);
        return $usuario;
    }

}