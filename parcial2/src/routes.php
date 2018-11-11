<?php

use Core\Api\UsuarioApi;
use Core\Api\CompraApi;
use Core\Middleware\MWparaAutentificar;

// Routes

$app->group('/', function () {
    $this->post('login/', UsuarioApi::class . ':login');
    //
    $this->group('usuario', function () {
        $this->post('/', UsuarioApi::class . ':cargarUno');
        $this->get('/', UsuarioApi::class . ':traerTodos')->add(MWparaAutentificar::class .':VerificarUsuarioAdministradorOHola');
    });
    //
    $this->group('compra', function () {
        $this->post('/', CompraApi::class . ':cargarUno')->add(MWparaAutentificar::class .':verificarUsuario');
        $this->get('/', CompraApi::class . ':traerTodos')->add(MWparaAutentificar::class .':verificarUsuario');
    });
})
    ->add(\Core\Middleware\MWLog::class .':guardarPeticion')
    ->add(\Core\Middleware\MWparaCORS::class .':HabilitarCORSTodos')
;
