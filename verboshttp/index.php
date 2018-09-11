<?php 
	include_once('init.php');
	//
	$data = Helper::getUsuarioParams();	
	$lista =  new UsuariosLista();
	$lista->save( new Usuario($data['nombre'], $data['clave']));	
	Helper::printUsuario($lista);



