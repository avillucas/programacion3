<?php 
class Rectangulo
{
    /** @var Punto $_vertice1 **/
    private $_vertice1 ;   
    /** @var Punto $_vertice2 **/
    private $_vertice2 ;   
    /** @var Punto $_vertice3 **/
    private $_vertice3 ;   
    /** @var Punto $_vertice4 **/
    private $_vertice4 ;   
    /** @var double $area **/
    private $area;
    /** @var int $ladoUno **/
    private $ladoUno;
    /** @var int $ladoDos **/
    private $ladoDos;
    /** @var double $perimetro **/
    private $perimetro;

    public function __contruct(Punto $p1, Punto $p2)
    {
        $this->_vertice1 = $p1;
        $this->_vertice3 = $p2;        
        //
        $this->_ladoUno = abs($p1->GetY() - $p3->GetY());
        $this->_ladoDos = abs($p1->GetX() - $p3->GetX());
        //
        $this->_vertice2 = new Punto($p3->GetX(),$p1->GetY());
        $this->_vertice4 = new Punto($p1->GetX(),$p3->GetX());
        $this->perimetro  = $this->ladoUno * 2 +$this->ladoDos *2;
        $this->area = $this->ladoUno * $this->ladoDos;
        //
    }

    public function GetArea()
    {
        return $this->area;
    }

    public function GetPerimetro()
    {
        return $this->perimetro;
    }

    public function Dibujar()
	{
		$base = floor($this->ladoUno);
		$alto = floor($this->ladoDos);
		$dibujo  = '';
		$linea = str_repeat('*',$base);
		for($a = 1 ; $a <= $alto; $a++)
		{			
			$dibujo .= $linea.'<br/>';	
		}
		return $dibujo;
	}

    public function __toString()
    {
        return  'ladoUno: '.$this->_ladoUno.'<br/> ladoDos:'.$this->_ladoDos.' <br/> superficie:'.$this->area.'<br/> perimetro: '.$this->perimetro.'<br/>'.$this->Dibujar();
    }
    
}