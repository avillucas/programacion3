<?php 
/**
Aplicación Nº 18 (Par e impar)
Crear una función llamada EsPar que reciba un valor entero como parámetro y devuelva TRUE
si este número es par ó FALSE si es impar.
Reutilizando el código anterior, crear la función EsImpar.
**/
function EsPar(  $valor) 
{
	//retorna 0 como resto si es que es par
	 return !boolval($valor % 2 ) ;
}

function EsImpar(  $valor) 
{
	 return !EsPar($valor);
}


echo 'EsPar ';
var_dump(EsPar(2));

echo '<br/>EsImpar ';
var_dump(EsPar(3));

