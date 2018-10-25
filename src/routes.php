<?php

use App\Controller\ProdutoController;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {

  $controller = new \App\Controller\IndexController();
  $controller->indexAction();
});

$app->get('/produtos', function (Request $request, Response $response, array $args) {

  $controller = new \App\Controller\ProdutoController();
  $controller->listarAction();
});

$app->any('/produtos-cadastrar', function($request, $response, $args) {

  $controller = new \App\Controller\ProdutoController();
  $controller->cadastrarAction();
});

$app->map(['GET', 'POST'], '/produtos-editar/{id}', function ($request, $response, $args) {

  $controller = new \App\Controller\ProdutoController();
  $controller->editarAction($args['id']);
});

$app->get('/produtos-apagar/{id}', function($request, $response, $args) {

  $controller = new \App\Controller\ProdutoController();
  $controller->excluirAction($args['id']);
});

$app->map(
        ['GET', 'POST'], '/login', function($request, $response, $args) {
  
  $controller = new \App\Controller\LoginController();
  $controller->loginAction();
}
);

$app->get('/logout', function($request, $response, $args) {
  
  $controller = new \App\Controller\LoginController();
  $controller->logoutAction();
  
});

/*
 * Rotas do WS
 */

$app->post('/ws/auth', function($request, $response, $args) {

  $controller = new \App\Controller\AuthWsController();
  return $controller->authAction($request, $response, $args);

});

$app->get('/ws/produtos', function($request, $response, $args) {

  $controller = new \App\Controller\ProdutoWsController();
  return $controller->listarAction($request, $response, $args);

});

$app->post('/ws/produtos', function($request, $response, $args) {

  $controller = new \App\Controller\ProdutoWsController();
  return $controller->cadastrarAction($request, $response, $args);

});

$app->post('/ws/produtos/{id}', function($request, $response, $args) {

  $controller = new \App\Controller\ProdutoWsController();
  return $controller->editarAction($request, $response, $args);

});

$app->delete('/ws/produtos/{id}', function($request, $response, $args) {

  $controller = new \App\Controller\ProdutoWsController();
  return $controller->excluirAction($request, $response, $args);

});

$app->post('/ws/produtos/{id}/apagar', function($request, $response, $args) {

  $controller = new \App\Controller\ProdutoWsController();
  return $controller->excluirAction($request, $response, $args);

});

