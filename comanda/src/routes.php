<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Core\Api\UsuarioApi;

// Routes
//LOGIN
$app->post('/login', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/login' route");

    // Render index view
  //  return $this->renderer->render($response, 'index.phtml', $args);
});

//USUARIO
$app->group('/usuarios',function(){
    $this->get('/',UsuarioApi::class.'::TraerTodos');
    $this->get('/{id}',UsuarioApi::class.'::TraerUno');
    $this->post('/',UsuarioApi::class.'::CargarUno');
    $this->delete('/',UsuarioApi::class.'::BorrarUno');
    $this->put('/',UsuarioApi::class.'::ModificarUno');
});



$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
