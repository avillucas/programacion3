<?php 
	define('DIR_CLASES','clases');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'Helper.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'IO.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'usuario.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'usuarioslista.php');	
	//
	$data = Helper::getUsuarioParams();	
	$lista =  new UsuariosLista();
	$lista->save( new Usuario($data['nombre'], $data['clave']));	
	Helper::printUsuario($lista);



