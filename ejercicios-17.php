<?php 
/**
Aplicación Nº 17 (Invertir palabra)
Crear una función que reciba como parámetro un string ( $palabra ) y un entero ( $max ). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
1 si la palabra pertenece a algún elemento del listado.
0 en caso contrario.
**/

function invertirPalabra(  $palabra,  $max)
{
	if(strlen($palabra) > $max) return 0;
	$validos = ['Recuperatorio', 'Parcial', 'Programacion'];
	if(!in_array($palabra, $validos)) return 0;
	return 1;
}

echo 'Valido ';
var_dump(invertirPalabra("Recuperatorio",16));
echo '<br>Largo ';
var_dump(invertirPalabra("Recuperatorio",2));
echo '<br>no permitido ';
var_dump(invertirPalabra("Recuperatoriosss",16));