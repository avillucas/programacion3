<?php
//coneccion a la base
include_once('.'.DIRECTORY_SEPARATOR.'config.php');
include_once('clases'.DIRECTORY_SEPARATOR.'router.php');
include_once('clases'.DIRECTORY_SEPARATOR.'AccesoDatos.php');
include_once('clases' . DIRECTORY_SEPARATOR . 'IEntidad.php');
//include_once('clases' . DIRECTORY_SEPARATOR . 'Perfil.php');
include_once('clases' . DIRECTORY_SEPARATOR . 'Usuario.php');
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
// un usuario intenta logueatse

try {
    //TODO AGREGAR EL PERFIL
    if(isset($_POST['email']))
    {
        $usuario = Usuario::login($_POST['email'],$_POST['password']);
        Router::sendJsonParamResponse($usuario , ['token','email']);
    }
    //TODO pasar a un ruteo
    if(isset($_GET['id']))
    {
        $usuario = Usuario::traerOFallar($_GET['id']);
        Router::sendJsonParamResponse($usuario , ['token','email']);
    }
//$usuario = Usuario::crear($_POST);
//Usuario::borrar($_GET['id']);
//Usuario::modificar($_GET['id'],$_POST);

}
catch(Exception $e)
{
    Router::sendJsonResponse($e->getMessage(),500);
}
