<?php 
	require_once('FiguraGeometrica.php');
	require_once('Rectangulo.php');
	require_once('Triangulo.php');
	$triangulo = new Triangulo(5,3);
	$rectangulo = new Rectangulo(10,5);
?>
<h1>Rectangulo</h1>
<?php echo $rectangulo->ToString();?>
<h1>Triangulo</h1>
<?php  echo $triangulo->ToString();?>