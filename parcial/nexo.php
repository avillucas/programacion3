<?php 
include_once('config.php');
include_once(CLASES_DIR.'router.php');
include_once(CLASES_DIR.'controller.php');
include_once(CLASES_DIR.'IO.php');
include_once(CLASES_DIR.'usuario.php');
include_once(CLASES_DIR.'usuarioCollection.php');
//
try{
    switch(Router::getCaso())
    {
        case 'crearUsuario':Controller::crearUsuario();break;
        case 'buscarUsuario':Controller::buscarUsuario();break;
        case 'listarUsuarios':Controller::listarUsuarios();break;
        default:
            throw new Exception('El caso $caso no existe ');
        break;
        
    }
}
catch(Exception $e)
{
    Router::sendResponse($e->getMessage(),500);
}

