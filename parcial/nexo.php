<?php 
include_once('config.php');
include_once(CLASES_DIR.'router.php');
include_once(CLASES_DIR.'controller.php');
include_once(CLASES_DIR.'IO.php');
include_once(CLASES_DIR.'alumno.php');
include_once(CLASES_DIR.'alumnosCollection.php');
//
try{
    switch(Router::getCaso())
    {
        case 'cargarAlumno':Controller::cargarAlumno();break;
        case 'consultarAlumno':Controller::consultarAlumno();break;
        case 'cargarMateria':Controller::cargarMateria();break;
        case 'inscribirAlumno':Controller::inscribirAlumno();break;
        case 'inscripciones':Controller::inscripciones();break;
        case 'modificarAlumno':Controller::modificarAlumno();break;
        case 'alumnos':Controller::alumnos();break;
        default:
            throw new Exception('El caso $caso no existe ');
        break;
        
    }
}
catch(Exception $e)
{
    Router::sendResponse($e->getMessage(),500);
}

