<?php

use Core\Api\UsuarioApi;
use Core\Api\MozoApi;
use Core\Api\SocioApi;
use Core\Api\PreparadorApi;
use Core\Api\MesaApi;
use Core\Api\AlimentosApi;
use Core\Api\ComandaApi;
use Core\Middleware\MWparaCORS;
use Core\Middleware\MWparaAutentificar;
// Routes

$app->group('/', function () {
    $this->post('login/', UsuarioApi::class . ':login');
    //usuarios
    $this->group('usuarios', function () {
        $this->post('/mozo/', MozoApi::class . ':cargarUno');
        $this->post('/preparador/', PreparadorApi::class . ':cargarUno');
        $this->post('/socio/', SocioApi::class . ':cargarUno');
    });
    //
    $this->group('mesas', function () {
        $this->post('/', MesaApi::class . ':cargarUno');
    });//
    $this->group('alimentos', function () {
        $this->post('/', AlimentoApi::class . ':cargarUno');
    });
    $this->group('comandas', function () {
        //$this->post('/', ComandaApi::class . ':cargarUno');
        //validar si es mozo
        $this->post('/tomar/', ComandaApi::class . ':tomar');
    });
})
//->add(MWparaCORS::class .':HabilitarCORS8080')
;
//TODO agregar middleware de Validacion de datos de cada peticion
//TODO agregar middleware que revise permisos ( politicas ) del usuario actual sobre la entidad a tocar