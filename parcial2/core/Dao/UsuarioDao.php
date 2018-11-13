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
            INSERT INTO usuarios (email,clave,perfil)
            VALUES (:email,:clave,:perfil)
        ");
        $consulta->bindValue(':email', $entidad->getEmail(), \PDO::PARAM_STR);
        $consulta->bindValue(':clave', $entidad->getClave(), \PDO::PARAM_STR);
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
				SET email = :email,
				clave=:clave,				
				perfil=:perfil			
				WHERE id = :id");
        $consulta->bindValue(':email', $entidad->getEmail(), \PDO::PARAM_STR);
        $consulta->bindValue(':clave', $entidad->getClave(), \PDO::PARAM_STR);
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
            " SELECT  id, email , clave,  perfil
                FROM  usuarios"
        );
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
    }

    public static function traerUno($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
            "SELECT id, email, clave,  perfil 
                FROM usuarios 
                WHERE id = :id"
        );
        $consulta->bindValue(':id', $id, \PDO::PARAM_INT);
        $consulta->execute();
        $usuario = $consulta->fetchObject(Usuario::class);
        return $usuario;
    }


}