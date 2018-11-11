<?php
namespace Core;

use Core\Dao\AccesoDatos;
use Core\Exceptions\SysNotFoundException;
use Core\Exceptions\SysNotImplementedException;
use Core\Exceptions\SysValidationException;
use Core\Models\UsuarioPerfiles;
use Slim\Exception\NotFoundException;

class Compra extends Entidad
{
    const IMAGEN_DIRECTORIO = 'IMGCompras';

    public $id = null;
    public $articulo;
    public $fecha;
    public $precio;
    public $usuarioId;
    public $imagen;

    public function __construct($id=null, $articulo=null, $fecha=null, $precio=null, $usuarioId=null,$imagen=null )
    {
        if(isset($id)){
            $this->id = $id;
        }
        if(isset($articulo))
        {
            $this->articulo = $articulo;
        }
        if(isset($fecha))
        {
            $this->fecha = $fecha;
        }
        if(isset($precio))
        {
            $this->setPrecio($precio);
        }
        if(isset($usuarioId))
        {
            $this->usuarioId = $usuarioId;
        }
        if(isset($imagen))
        {
            $this->imagen = $imagen;
        }
    }

    private function setPrecio($precio)
    {
        $this->precio = floatval($precio);
    }

    public static function crear($data)
    {
        $compra = new Compra(null,$data['articulo'], $data['fecha'], $data['precio'], $data['usuarioId']);
        $compra->save();
        return $compra;
    }

    protected function insertar()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        /** @var \PDOStatement $consulta */
        $consulta =$objetoAccesoDato->RetornarConsulta("
            INSERT INTO compras (fecha,articulo,precio,usuario_id)
            VALUES (:fecha,:articulo,:precio,:usuario_id)
        ");
        $consulta->bindValue(':fecha',$this->fecha, \PDO::PARAM_STR);
        $consulta->bindValue(':articulo', $this->articulo, \PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, \PDO::PARAM_STR);
        $consulta->bindValue(':usuario_id', $this->usuarioId, \PDO::PARAM_INT);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    protected function actualizar()
    {
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
        $consulta->bindValue(':fecha',$this->fecha, \PDO::PARAM_STR);
        $consulta->bindValue(':articulo', $this->articulo, \PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, \PDO::PARAM_STR);
        $consulta->bindValue(':usuario_id', $this->usuarioId, \PDO::PARAM_INT);
        $consulta->bindValue(':imagen', $this->imagen, \PDO::PARAM_STR);
        $consulta->bindValue(':id',$this->id, \PDO::PARAM_INT);
        return $consulta->execute();
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

    public function __toArray()
    {
        return ['id' =>$this->id, 'fecha' =>$this->fecha, 'articulo'=>$this->articulo,'precio'=>$this->precio,'imagen'=>$this->getImagenName()];
    }

    public function getId()
    {
        return $this->id;
    }

    static function modificar($id, $data)
    {
     throw  new SysNotImplementedException();
    }

    static function borrar($id)
    {
        throw  new SysNotImplementedException();
    }

    protected function eliminar()
    {
        throw  new SysNotImplementedException();
    }

    public static function generarNombreImagen(Compra $compra)
    {
        return $compra->id.'-'.$compra->articulo;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
}