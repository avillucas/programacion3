<?php 
class Producto
{
    private $id;
    private $nombre;
    private $codigoBarras;
    private $image;

    public function __construct( $nombre,  $codigoBarras, $image = 'default.jpg',$id=null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->codigoBarras = $codigoBarras;
        $this->image= $image;        
    }

    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }

    public function __toString()
    {
        return 'nombre: '.$this->nombre.' Codigo de barras:'.$this->codigoBarras;
    }

    public function getFileName()
    {
        return $this->codigoBarras.'-'.$this->nombre;
    }

    public static function populate($item)
	{
		return  new Producto($item['nombre'],$item['codigo'],$item['image'],$item['id']);
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
    
    public function __toArray()
	{
		return ['id'=>$this->id,'nombre' => $this->nombre, 'codigoBarra' => $this->codigoBarras,'image:'=>$this->image];
	}

	public function __toJson()
	{
		return json_encode($this->__toArray());
    }
    
    public function setImage($filePath)
    {
        $this->image = $filePath;
    }
    
}