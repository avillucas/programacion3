<?php 
/**
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color , un método virtual ( ToString ) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
**/
abstract class FiguraGeometrica
{

	protected $_color;
	protected $_superficie;
	protected $_perimetro;

	public function __construct()
	{
		$this->CalcularDatos();
	}

	public function getColor()
	{
		return $this->_color;
	}

	public function setColor(string $color)
	{
		$this->_color = $color;
	}

	public abstract function Dibujar();
	
	protected abstract function CalcularDatos();	

	protected   function ToString()
	{
		return 'Color: '.$this->_color;
	} 

}