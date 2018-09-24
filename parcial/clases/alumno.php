<?php 
class Alumno 
{	
	private $nombre;
    private $apellido;
    private $email;

	public function __construct($email, $nombre, $apellido )
	{		
		$this->email  = $email;
		$this->nombre  = $nombre;
		$this->apellido  = $apellido;		
	}	

	public function __toString()
	{
		return  'nombre:'.$this->nombre.'apellido:'.$this->apellido.' <br/>email:'.$this->email ;
	}

	public function __toArray()
	{
		return ['nombre' => $this->nombre,'apellido'=>$this->apellido, 'email' => $this->email];
	}

	public function __toJson()
	{
		return json_encode($this->__toArray());
	}

	public static function populate($item)
	{
		return  new Usuario($item['nombre'],$item['apellido'],$item['email']);
	}
	
	public function getNombre()
	{
		return $this->nombre;
	}

	public function getApellido()
	{
		return $this->apellido;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function update(array $data)
	{
		if(isset($data['nombre']))
			$this->nombre = $data['nombre'];
		if(isset($data['apellido']))
			$this->apellido = $data['apellido'];
		if(isset($data['email']))
			$this->email = $data['email'];
	}
}