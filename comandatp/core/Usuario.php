<?php
namespace Core;

use Core\Dao\AccesoDatos;
use Core\Exceptions\SysNotFoundException;
use Core\Exceptions\SysValidationException;
use Core\Models\UsuarioPerfiles;

class Usuario extends Entidad
{
    //TODO buscar como eliminar esto en un DAO de usuario para poder dejarlos privados
    public $id = null;
    public $email;
    public $password;
    public $perfil;

    public function __construct($id=null, $email=null, $strPassword=null, $perfil=null )
    {
        if(isset($id)){
            $this->id = $id;
        }
        if(isset($email))
        {
            $this->email = $email;
        }
        if(isset($perfil))
        {
            $this->setPerfil($perfil);
        }
        if(isset($strPassword))
        {
            $this->setPassword($strPassword);
        }
    }

    private function setPerfil($perfil)
    {
        UsuarioPerfiles::existsOFallar($perfil);
        $this->perfil = $perfil;
    }

    public function setPassword($password)
    {
      $this->password = self::encriptar($password);
    }

    /**
     * Crea un usuario en base a los datos enviados
     * @param $data
     * @return Usuario
     */
    public static function crear($data)
    {
        $usuario = new Usuario(null,$data['email'], $data['password'], $data['perfil']);
        $usuario->save();
        return $usuario;
    }

    /**
     * @param $id del usuario a eliminar
     * @return bool
     * @throws SysNotFoundException
     */
    public static function borrar($id)
    {
        $id = intval($id);
        $usuario = Usuario::traerOFallar($id);
        $usuario->eliminar();
        return true;
    }

    public static function modificar($id, $data)
    {
        $usuario = Usuario::traerOFallar(intval($id));
        /** @var Usuario $usuario */
        if(isset($data['password']))
        {
            $usuario->setPassword($data['password']);
        }
        if(isset($data['email']))
        {
            $usuario->email = $data['email'];
        }
        if(isset($data['perfil']))
        {
            $usuario->perfil = $data['perfil'];
        }
        $usuario->save();
        return true;
    }

    /**
     * Guarda el usuario en la base de datos
     * @return string
     */
    protected function insertar()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            INSERT INTO usuarios (email,password,perfil)
            VALUES (:email,:password,:perfil)
        ");
        $consulta->bindValue(':email',$this->email, \PDO::PARAM_STR);
        $consulta->bindValue(':password', $this->password, \PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $this->perfil, \PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    /**
     * Actualiza el usuario en la base de datos
     * @return bool
     */
    protected function actualizar()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
				UPDATE usuarios 
				SET email = :email,
				password=:password,
				perfil=:perfil			
				WHERE id = :id");
        $consulta->bindValue(':email',$this->email, \PDO::PARAM_STR);
        $consulta->bindValue(':password',$this->password, \PDO::PARAM_STR);
        $consulta->bindValue(':perfil',$this->perfil, \PDO::PARAM_STR);
        $consulta->bindValue(':id',$this->id, \PDO::PARAM_INT);
        return $consulta->execute();
    }

    /**
     * Elimina la entidad de la base
     * @return bool
     */
    protected function eliminar()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
				DELETE 
				FROM usuarios 				
				WHERE id=:id
        ");
        $consulta->bindValue(':id',$this->id, \PDO::PARAM_INT);
        $consulta->execute();
        return true;
    }

    public static function traerTodos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
            " SELECT  id, email , password , perfil
                FROM  usuarios"
        );
        $consulta->execute();
        return $consulta->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
    }

    public static function traerUno($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
            "SELECT id, email, password, perfil 
                FROM usuarios 
                WHERE id = :id"
        );
        $consulta->bindValue(':id',$id,\PDO::PARAM_INT);
        $consulta->execute();
        $usuario = $consulta->fetchObject(Usuario::class);
        return $usuario;
    }

    public function __toArray()
    {
        return ['id' =>$this->id, 'email' =>$this->email, 'password'=>$this->password,'perfil'=>UsuarioPerfiles::getName($this->perfil)];
    }

    /**
     * Retorna el di del usuario de existir
     * @return null|int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Encripta un password enviado en string
     * @param $passwordString
     * @return string
     */
    protected static function encriptar($passwordString)
    {
        return md5($passwordString);
    }

    /**
     * Buscar un usuario por email envia un error en caso de no exista ninguno
     * @param $email
     * @return false|Usuario
     */
    public static function traerUnoPorEmail($email)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var PDOStatement $consulta */
        $consulta =$objetoAccesoDato->RetornarConsulta("
                SELECT id, email, password , perfil 
                FROM  usuarios 
                WHERE email = :email
               ");
        $consulta->bindValue(':email',$email, \PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject(Usuario::class);

    }

    /**
     * Busca un usuario por $email y passwrod
     * @param $email
     * @param $passwordString
     * @return boolean|Usuario
     */
    public static function traerUnoPorEmailPassword($email, $passwordString)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOException $consulta */
        $consulta =$objetoAccesoDato->RetornarConsulta("
                SELECT id, email, password  
                FROM  usuarios 
                WHERE email = :email
                AND password = :password
               ");
        $consulta->bindValue(':email',$email, \PDO::PARAM_STR);
        $consulta->bindValue(':password',Usuario::encriptar($passwordString), \PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Usuario');

    }

    public static function login($email, $password, $perfil)
    {
        $usuario = Usuario::traerUnoPorEmail($email);
        if(!$usuario)
        {
            throw new SysValidationException('No existe un usuario con ese email');
        }
       //
        if($usuario->password != Usuario::encriptar($password))
        {
            throw new SysValidationException('El password es incorrecto');
        }
        if($usuario->perfil != $perfil)
        {
            throw new SysValidationException('El perfil es incorrecto');
        }


        return $usuario;
    }

}