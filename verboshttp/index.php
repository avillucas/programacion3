<?php 
	include_once('init.php');
	//
	try{	
		$router = new Router($_SERVER);
		$class = $router->getClass();
		switch($router->getMethod())
		{
			case 'DELETE': 
				$$class->delete($router->ge);
			break;
			case 'PUT': 
				$lista =  new UsuariosLista();
				$id = $router->getRequestedId();
				$usuario = $lista->find($id);
				if(!$usuario)
				{
					throw new \Exception("El usuario ".$id." no existe", 1);						
				}													
				$data = Helper::getUsuarioParams();				
				$usuario->update($data);
				$lista->save( $usuario);	
			break;
			case 'POST': 
				//agregar 1
				$lista =  new UsuariosLista();
				$data = Helper::getUsuarioParams();
				$lista->save( new Usuario($data['nombre'], $data['clave']));	
			break;
			case 'GET': 				
				$lista =  new UsuariosLista();
				if($router->hasRequestedId())
				{
					$id = $router->getRequestedId();
					$usuario = $lista->find($id);
					if(!$usuario)
					{
						throw new \Exception("El usuario ".$id." no existe", 1);
						
					}
					Helper::printUsuarioJson($usuario);
				}
				else
				{				
					Helper::printUsuariosJson($lista);
				}				
			break;		
		}

	}
	catch( \Exception $e)
	{	
		Router::sendResponse($e->getMessage(),500);
	}




