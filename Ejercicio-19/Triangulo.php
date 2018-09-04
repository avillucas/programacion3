<?php 
class Triangulo extends FiguraGeometrica
{
	const SPACE_CHAR = '&nbsp';
	/** @var dobuble $_altura **/
	private $_altura;
	/** @var dobuble $_base **/
	private $_base;
	
	
	public function __construct( $b, $h)
	{
			$this->_altura = $h;
			$this->_base = $b;			
			parent::__construct();			
	}

	protected function CalcularDatos()
	{	
		//TODO revisar
		$lado = sqrt(pow($this->_altura,2)+pow($this->_base/2,2));
		$this->_superficie = ($this->_base * $this->_altura)/2;
		$this->_perimetro =  $this->_base+$lado*2;
	}

	public function Dibujar()
	{		
		$altura = floor($this->_altura);
		$base = floor($this->_base);
		$dibujo  = '';
		$i = 0 ;
		for($b = $base ; $b > 0  ; $b = $b-2)
		{			
			$e  = ( $base - $b )/2;			
			$dibujo  = str_repeat(self::SPACE_CHAR,$e).str_repeat('*',$b).'<br/>'.$dibujo ;	
			if($i == $altura){
				break;
			}else{
				$i++;
			}
		}
		return $dibujo;		
	}

	public function ToString()
	{
		return  'Color:'.parent::ToString().'<br/>base: '.$this->_base.'<br/> altura:'.$this->_altura.' <br/> superficie:'.$this->_superficie.'<br/> perimetro: '.$this->_perimetro.'<br/>'.$this->Dibujar();
	}
}