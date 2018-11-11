<?php
namespace Core;

use Core\Dao\AccesoDatos;
use Core\Dao\CompraDao;
use Core\Exceptions\SysNotFoundException;
use Core\Exceptions\SysNotImplementedException;
use Core\Exceptions\SysValidationException;
use Core\Models\UsuarioPerfiles;
use Slim\Exception\NotFoundException;

class Compra extends Entidad
{
    const IMAGEN_DIRECTORIO = 'IMGCompras';

    /** @var int $id */
    public $id = null;
    /** @var string $articulo  */
    public $articulo;
    /** @var string $fecha  */
    public $fecha;
    /** @var float $precio  */
    public $precio;
    /** @var int $usuarioId  */
    public $usuarioId;
    /** @var string $imagen  */
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

    public function __toArray()
    {
        return ['id' =>$this->id, 'fecha' =>$this->fecha, 'articulo'=>$this->articulo,'precio'=>$this->precio,'imagen'=>$this->getImagenName()];
    }

    static function modificar($id, $data)
    {
     throw  new SysNotImplementedException();
    }

    static function borrar($id)
    {
        throw  new SysNotImplementedException();
    }

    public function save()
    {
        if(isset($this->id)){
            CompraDao::actualizar($this);
            return ;
        }
        $this->id =  CompraDao::insertar($this);
        return ;
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

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getArticulo()
    {
        return $this->articulo;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @return int
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

}