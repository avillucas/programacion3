<?php 
class Usuario
{	
	private $id;
	private $nombre;
	private $clave;

	public function __construct($nombre, $clave,$id = null)
	{		
		$this->id  = $id;
		$this->nombre  = $nombre;
		$this->clave  = $clave;
	}	

	public function __toString()
	{
		return 'nombre:'.$this->nombre.' <br/>clave:'.$this->clave ;
	}

	public function __toArray()
	{
		return ['id'=>$this->id,'nombre' => $this->nombre, 'clave' => $this->clave];
	}

	public function __toJson()
	{
		return json_encode($this->__toArray());
	}

	public static function populate($item)
	{
		return  new Usuario($item['nombre'],$item['clave'],$item['id']);
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function hasId()
	{
		return !empty($this->id);
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getClave()
	{
		return $this->clave;
	}
}