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


	public static function printUsuarios(UsuariosLista $usuariosLista)
	{
		echo '<h1>Lista</h1><ul>';		
		$usuario = $usuariosLista->getNext();
		while($usuario !== false)
		{
			echo '<li>'.$usuario->__toString().'</li>';						
			$usuario = $usuariosLista->getNext();
		}
		echo '</ul>';
	}


	public static function printUsuario(Usuario $usuario)
	{
		
		echo '<p>'.$usuario->__toString().'</p>';							
		
	}


	public static function printUsuariosJson(UsuariosLista $usuariosLista)
	{
	
		$usuario = $usuariosLista->getNext();
		while($usuario !== false)
		{
			echo $usuario->__toJson();						
			$usuario = $usuariosLista->getNext();
		}	
	}


	public static function printUsuarioJson(Usuario $usuario)
	{
		
		echo $usuario->__toJson();							
		
	}
}
