<?php

use Core\Api\UsuarioApi;
use Core\Api\MozoApi;
use Core\Api\SocioApi;
use Core\Api\PreparadorApi;
use Core\Middleware\MWparaCORS;
use Core\Middleware\MWparaAutentificar;
// Routes

$app->group('/', function () {
    $this->post('login/', UsuarioApi::class . ':login');
    //usuarios
    $this->group('usuarios', function () {
        $this->post('/mozo', MozoApi::class . ':cargarUno');
        $this->post('/preparador', PreparadorApi::class . ':cargarUno');
        $this->post('/socio', SocioApi::class . ':cargarUno');
    });
    //
    $this->group('mesa', function () {
        $this->post('/', MesaApi::class . ':cargarUno');
    });
})
//->add(MWparaCORS::class .':HabilitarCORS8080')
;
//TODO agregar middleware de Validacion de datos de cada peticion
//TODO agregar middleware que revise permisos ( politicas ) del usuario actual sobre la entidad a tocar