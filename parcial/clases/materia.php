<?php 
class Materia 
{	
	private $materia;
    private $codigoMateria;
    private $cupo;
    private $aula;

	public function __construct($materia, $codigoMateria, $cupo, $aula )
	{		
		$this->materia  = $materia;
		$this->codigoMateria  = $codigoMateria;
		$this->cupo  = $cupo;				
		$this->aula  = $aula;		
	}	

	public function __toString()
	{
		return  'materia:'.$this->materia.'codigoMateria:'.$this->codigoMateria.' <br/>cupo:'.$this->cupo .' <br/>aula:'.$this->aula ;
	}

	public function __toArray()
	{
		return ['materia' => $this->materia,'codigoMateria'=>$this->codigoMateria, 'cupo' => $this->cupo, 'aula' => $this->aula];
	}

	public function __toJson()
	{
		return json_encode($this->__toArray());
	}

	public static function populate($item)
	{
		return  new Usuario($item['materia'],$item['codigoMateria'],$item['cupo'],$item['aula']);
	}
	
	public function getMateria()
	{
		return $this->materia;
	}

	public function getcodigoMateria()
	{
		return $this->codigoMateria;
	}

	public function getCupo()
	{
		return $this->cupo;
	}

	public function getAula()
	{
		return $this->aula;
	}
	
	public function update(array $data)
	{
		if(isset($data['materia']))
			$this->materia = $data['materia'];
		if(isset($data['codigoMateria']))
			$this->codigoMateria = $data['codigoMateria'];
		if(isset($data['cupo']))
			$this->cupo = $data['cupo'];
		if(isset($data['aula']))
			$this->cupo = $data['aula'];
	}
}