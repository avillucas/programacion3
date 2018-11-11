<?php
namespace Core\Dao;

use Core\Entidad;
use Core\Usuario;

class UsuarioDao extends Dao
{

    public static function insertar(Entidad $entidad)
    {
        /** @var Usuario $entidad */
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
            INSERT INTO usuarios (nombre,clave,sexo,perfil)
            VALUES (:nombre,:clave,:sexo,:perfil)
        ");
        $consulta->bindValue(':nombre', $entidad->getNombre(), \PDO::PARAM_STR);
        $consulta->bindValue(':clave', $entidad->getClave(), \PDO::PARAM_STR);
        $consulta->bindValue(':sexo', $entidad->getSexo(), \PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $entidad->getPerfil(), \PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function actualizar(Entidad $entidad)
    {
        /** @var Usuario $entidad */
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				UPDATE usuarios 
				SET nombre = :nombre,
				clave=:clave,
				sexo=:sexo,
				perfil=:perfil			
				WHERE id = :id");
        $consulta->bindValue(':nombre', $entidad->getNombre(), \PDO::PARAM_STR);
        $consulta->bindValue(':clave', $entidad->getClave(), \PDO::PARAM_STR);
        $consulta->bindValue(':sexo', $entidad->getSexo(), \PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $entidad->getPerfil(), \PDO::PARAM_STR);
        $consulta->bindValue(':id', $entidad->getId(), \PDO::PARAM_INT);
        return $consulta->execute();
    }

    public static function eliminar(Entidad $entidad)
    {
        /** @var Usuario $entidad */
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				DELETE 
				FROM usuarios 				
				WHERE id=:id
        ");
        $consulta->bindValue(':id', $entidad->getId(), \PDO::PARAM_INT);
        $consulta->execute();
        return true;
    }

    public static function traerTodos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
            " SELECT  id, nombre , clave, sexo, perfil
                FROM  usuarios"
        );
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
    }

    public static function traerUno($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
            "SELECT id, nombre, clave, sexo, perfil 
                FROM usuarios 
                WHERE id = :id"
        );
        $consulta->bindValue(':id', $id, \PDO::PARAM_INT);
        $consulta->execute();
        $usuario = $consulta->fetchObject(Usuario::class);
        return $usuario;
    }


}