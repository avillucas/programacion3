<?php 
/** 
Aplicación Nº 16 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
**/
function invertiPalabra( array $palabra)
{
  $out = [];
  $l = count($palabra)-1;
  for($i = $l ; $i >= 0;$i--)
  {
  	$out[] = $palabra[$i];
  }
  return $out;
}
$original = array('H','O','L','A');
$inverted = invertiPalabra($original);
echo '<pre>';
var_dump($inverted);