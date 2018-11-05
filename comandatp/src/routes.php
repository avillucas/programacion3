<?php

use Core\Api\UsuarioApi;

// Routes

$app->group('/', function () {
    $this->post('login', UsuarioApi::class . ':ingresar');

    $this->group('usuarios', function () {
        $this->get('/', UsuarioApi::class . ':traerTodos');
        $this->get('/{id}', UsuarioApi::class . ':traerUno');
        $this->post('/', UsuarioApi::class . ':CargarUno');
        $this->delete('/', UsuarioApi::class . ':BorrarUno');
        $this->put('/', UsuarioApi::class . ':ModificarUno');
    });
});
//TODO agregar middleware de CORPS
//TODO agregar middleware de Validacion de datos de cada peticion
//TODO agregar middleware que revise permisos ( politicas ) del usuario actual sobre la entidad a tocar