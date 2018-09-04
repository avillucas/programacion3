<?php 
class Helper
{
	/** functions **/
	public static function getUsuarioParams()
	{
		//TODO validate POST EXISTS
		$params['nombre'] = $_POST['nombre'];
		$params['clave'] = $_POST['clave'];
		//TODO validate
		return $params;
	}

	public static function printUsuario($lista)
	{
		echo '<h1>Lista</h1><ul>';
		//foreach($usuarios as $usuario)
		//for($i = 0 ; $i < $lista->count(); $i++)
		while($usuario !== false ){					
			echo '<li>'.$usuario->__toString().'</li>';			
			$usuario = $lista->getNext();
		}
		echo '</ul>';
	}
}
