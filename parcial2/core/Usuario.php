<?php
namespace Core;

use Core\Dao\AccesoDatos;
use Core\Dao\UsuarioDao;
use Core\Exceptions\SysNotFoundException;
use Core\Exceptions\SysValidationException;
use Core\Models\UsuarioPerfiles;
use Slim\Exception\NotFoundException;

class Usuario extends Entidad
{

    const PERFIL_USUARIO = 'usuario';
    const PERFIL_ADMINISTRADOR = 'admin';

    /** @var int $id */
    public $id = null;
    /** @var string $nombre  */
    public $nombre;
    /** @var string $clave  */
    public $clave;
    /** @var string $sexo  */
    public $sexo;
    /** @var string $perfil  */
    public $perfil;

    public function __construct($id = null, $nombre = null, $strClave = null, $sexo = null, $perfil = null)
    {
        if (isset($id)) {
            $this->id = $id;
        }
        if (isset($nombre)) {
            $this->nombre = $nombre;
        }
        if (isset($strClave)) {
            $this->setClave($strClave);
        }
        if (isset($sexo)) {
            $this->sexo = $sexo;
        }
        if (isset($perfil)) {
            $this->setPerfil($perfil);
        }
    }

    private function setPerfil($perfil)
    {
        if (!in_array($perfil, [Usuario::PERFIL_ADMINISTRADOR, Usuario::PERFIL_USUARIO])) {
            throw  new NotFoundException("no existe un perfil " . $perfil);
        }
        $this->perfil = $perfil;
    }

    public function setClave($password)
    {
        $this->clave = self::encriptar($password);
    }

    public static function crear($data)
    {
        $perfil = (!isset($data['perfil'])) ? Usuario::PERFIL_USUARIO : $data['perfil'];
        $usuario = new Usuario(null, $data['nombre'], $data['clave'], $data['sexo'], $perfil);
        $usuario->save();
        return $usuario;
    }

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
        if (isset($data['nombre'])) {
            $usuario->nombre = $data['nombre'];
        }
        if (isset($data['clave'])) {
            $usuario->setClave($data['clave']);
        }
        if (isset($data['sexo'])) {
            $usuario->sexo = $data['sexo'];
        }
        if (isset($data['perfil'])) {
            $usuario->setPerfil($data['perfil']);
        }
        $usuario->save();
        return true;
    }

    public function save()
    {
        if(isset($this->id)){
            UsuarioDao::actualizar($this);
            return ;
        }
        $this->id =  UsuarioDao::insertar($this);
        return ;
    }

    public function __toArray()
    {
        return ['id' => $this->id, 'nombre' => $this->nombre, 'clave' => $this->clave, 'sexo' => $this->sexo, 'perfil' => $this->perfil];
    }

    protected static function encriptar($passwordString)
    {
        return md5($passwordString);
    }

    public static function traerUnoPorNombre($nombre)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var PDOStatement $consulta */
        $consulta = $objetoAccesoDato->RetornarConsulta("
                SELECT id, nombre, clave, sexo , perfil 
                FROM  usuarios 
                WHERE nombre = :nombre
               ");
        $consulta->bindValue(':nombre', $nombre, \PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject(Usuario::class);

    }

    public static function login($nombre, $clave, $sexo)
    {
        $usuario = Usuario::traerUnoPorNombre($nombre);
        if (!$usuario) {
            throw new SysValidationException('No existe un usuario con ese nombre');
        }
        //
        if ($usuario->clave != Usuario::encriptar($clave)) {
            throw new SysValidationException('La clave es incorrecta');
        }

        if ($usuario->sexo != $sexo) {
            throw new SysValidationException('El sexo es incorrecto');
        }
        return $usuario;
    }

    public function setClaveEncriptada($clave)
    {
        return $this->clave = $clave;
    }

    public function isAdmin()
    {
        return boolval($this->perfil == Usuario::PERFIL_ADMINISTRADOR);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @return string
     */
    public function getPerfil()
    {
        return $this->perfil;
    }
}