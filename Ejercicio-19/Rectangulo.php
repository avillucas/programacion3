<?php 
class Rectangulo extends FiguraGeometrica
{
	/** @var dobuble $_ladoUno **/
	private $_ladoUno;
	/** @var dobuble $_ladoDos **/
	private $_ladoDos;
	
	
	public function __construct( $l1, $l2)
	{
			$this->_ladoUno = $l1;
			$this->_ladoDos = $l2;
			parent::__construct();
	}

	protected function CalcularDatos()
	{
		$this->_superficie = $this->_ladoUno * $this->_ladoDos;
		$this->_perimetro =  $this->_ladoUno*2+$this->_ladoDos*2;
	}

	public function Dibujar()
	{
		$base = floor($this->_ladoUno);
		$alto = floor($this->_ladoDos);
		$dibujo  = '';
		$linea = str_repeat('*',$base);
		for($a = 1 ; $a <= $alto; $a++)
		{			
			$dibujo .= $linea.'<br/>';	
		}
		return $dibujo;
	}

	public function ToString()
	{
		return  'Color:'.parent::ToString().'<br/>ladoUno: '.$this->_ladoUno.'<br/> ladoDos:'.$this->_ladoDos.' <br/> superficie:'.$this->_superficie.'<br/> perimetro: '.$this->_perimetro.'<br/>'.$this->Dibujar();
	}
}