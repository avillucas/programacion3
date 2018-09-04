<?php 
/** 
Aplicación Nº 15 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
que las calcule invocando la función pow ).
**/
function pow4()
{
	for($i = 1 ; $i <= 4; $i++)
			for($b = 1 ; $b <= 4; $b++)
				echo '<br/>'.$i.'<sup>'.$b.'</sup> = '.pow($i,$b);
}

pow4();