<?php 
	include_once('config.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'helper.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'router.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'IO.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'usuario.php');
	include_once(DIR_CLASES.DIRECTORY_SEPARATOR.'usuarioslista.php');	

	$router = Router($_SERVER);
	$class = $router->getClass();
	switch($router->getMethod())
	{
		case 'DELETE': break;
		case 'PUT': break;
		case 'POST': break;
		case 'GET': break;
	}