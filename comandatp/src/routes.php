<?php

use Core\Api\UsuarioApi;
use Core\Middleware\MWparaCORS;
use Core\Middleware\MWparaAutentificar;
// Routes

$app->group('/', function () {
    $this->post('login/', UsuarioApi::class . ':login');
    //$this->post('registro/', UsuarioApi::class . ':registro');//TODO crear con estado inactivo ?
    //datos determinados
    $this->group('usuarios', function () {
        $this->get('/', UsuarioApi::class . ':traerTodos');
        $this->get('/{id}/', UsuarioApi::class . ':traerUno');
        $this->post('/', UsuarioApi::class . ':cargarUno');
        $this->delete('/{id}/', UsuarioApi::class . ':borrarUno');
        $this->put('/{id}/', UsuarioApi::class . ':modificarUno');
    })
    ->add(MWparaAutentificar::class .':VerificarUsuarioAdministrador')
    ;
})
->add(MWparaCORS::class .':HabilitarCORS8080')
;
//TODO agregar middleware de Validacion de datos de cada peticion
//TODO agregar middleware que revise permisos ( politicas ) del usuario actual sobre la entidad a tocar