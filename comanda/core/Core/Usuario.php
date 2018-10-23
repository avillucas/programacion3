<?php
namespace Core\Core;

class Usuario implements IEntidad
{
    public $id = null;
    public $email;
    public $password;
    public $token;

    public function __construct($id=null, $email=null, $password=null )
    {
       if(isset($id)){
            $this->id = $id;
       }
       if(isset($email))
       {
            $this->email = $email;
       }
       if(isset($password))
       {
           $this->password = $password;
       }
    }

    /**
     * Guarda un usuario , lo modifica de existir , loc crea en caso de que no exista
     */
    public function save()
    {
        if(isset($this->id)){
            $this->actualizar();
            return ;
        }
        $this->id =  $this->insertar();
        return ;
    }

    /**
     * Crea un usuario en base a los datos enviados
     * @param $data
     * @return Usuario
     */
    public static function crear($data)
    {
        $usuario = new Usuario(null,$data['email'], $data['password']);
        $usuario->save();
        return $usuario;
    }

    /**
     * Modifica el usuario de identificador $id con los datos de $data
     * @param $id identificador del usuario
     * @param $data informacion a actualizar
     * @return bool
     * @throws Exception
     */
    public static function modificar($id, $data)
    {
        $usuario = Usuario::traerOFallar(intval($id));
        /** @var Usuario $usuario */
        if(isset($data['password']))
        {
            $usuario->password = Usuario::encriptar($data['password']);
        }
        if(isset($data['email']))
        {
            $usuario->email = $data['email'];
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
            INSERT INTO usuarios (email,password)
            VALUES (:email,:password)
        ");
        $consulta->bindValue(':email',$this->email, PDO::PARAM_STR);
        $consulta->bindValue(':password', Usuario::encriptar($this->password), PDO::PARAM_STR);
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
				token=:token			
				WHERE id = :id");
        $consulta->bindValue(':email',$this->email, PDO::PARAM_STR);
        $consulta->bindValue(':password',$this->password, PDO::PARAM_STR);
        $consulta->bindValue(':token',$this->token, PDO::PARAM_STR);
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
        return $consulta->execute();
    }

    /**
     * Borrar el usuario con identificador $id
     * @param $id
     * @return bool
     * @throws Exception
     */
    public static function borrar($id)
    {
        $id = intval($id);
        $usuario = Usuario::traerOFallar($id);
        $usuario->eliminar();
        return true;
    }

    /**
     * Elimina al usuario actual
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
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
        $consulta->execute();
        return true;
    }

    /**
     * Trae un listado de todos los usuarios
     * @return array
     */
    public static function traerTodos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
            " SELECT  id, email , password 
                FROM  usuarios"
        );
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
    }

    /**
     * Trea un usuario , retorna false en caso de no existir
     * @param $id
     * @return mixed
     */
    public static function traerUno($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
            "SELECT id, email, password, token
                FROM usuarios 
                WHERE id = :id"
        );
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        $usuario = $consulta->fetchObject('Usuario');
        return $usuario;
    }

    /**
     * Retornoa un usuario o envia un error
     * @param $id
     * @return Usuario
     * @throws Exception
     */
    public static function traerOFallar($id)
    {
        $usuario = Usuario::traerUno($id);
        if(!$usuario)
        {
            throw new Exception('No existe el recurso buscado');
        }
        return $usuario;
    }

    /**
     * Retorna un listado de los datos del usuario
     * @return string
     */
    public function __toString()
    {
        $data = array_map(function($key,$value){ return $key.':'.$value;},$this->__toArray());
        return implode(' ',$data);
    }

    /**
     * Retorna un array con los datos del usuario
     * @return array
     */
    public function __toArray()
    {
        return ['id' =>$this->id, 'email' =>$this->email, 'password'=>$this->password,'token'=>$this->token];
    }

    /**
     * Retorna un Json con los datos del usuario
     * @return string
     */
    public function __toJson()
    {
        return json_encode($this->__toArray(),true);
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
     * @param $email
     * @param $password
     * @return bool|Usuario
     * @throws Exception
     */
    public static function login($email, $password)
    {
        $usuario = Usuario::traerUnoPorEmail($email);
        if(!$usuario)
        {
            throw new Exception('No existe un usuario con ese email');
        }
        //
        if($usuario->password != Usuario::encriptar($password))
        {
            throw new Exception('El password es incorrecto');
        }
        //TOKEN
        $usuario->asignarNuevoToken();
        return $usuario;
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
                SELECT id, email, password  
                FROM  usuarios 
                WHERE email = :email
               ");
        $consulta->bindValue(':email',$email, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Usuario');

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
        /** @var PDOStatement $consulta */
        $consulta =$objetoAccesoDato->RetornarConsulta("
                SELECT id, email, password  
                FROM  usuarios 
                WHERE email = :email
                AND password = :password
               ");
        $consulta->bindValue(':email',$email, PDO::PARAM_STR);
        $consulta->bindValue(':password',Usuario::encriptar($passwordString), PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Usuario');

    }

    /**
     * Retorna un token recien generado
     * @return string
     */
    public static function generarToken()
    {
        return md5(time());
    }

    /**
     * Asigna un nuevo token  a un usuario
     */
    public function asignarNuevoToken()
    {
        $this->token = Usuario::generarToken();
        $this->save();
    }
}