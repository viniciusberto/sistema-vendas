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

$app->any('/produtos-cadastrar', function ($request, $response, $args) {

    $controller = new \App\Controller\ProdutoController();
    $controller->cadastrarAction();
});

$app->map(['GET', 'POST'], '/produtos-editar/{id}', function ($request, $response, $args) {

    $controller = new \App\Controller\ProdutoController();
    $controller->editarAction($args['id']);
});

$app->get('/produtos-apagar/{id}', function ($request, $response, $args) {

    $controller = new \App\Controller\ProdutoController();
    $controller->excluirAction($args['id']);
});

$app->map(
    ['GET', 'POST'], '/login', function ($request, $response, $args) {

    $controller = new \App\Controller\LoginController();
    $controller->loginAction();
}
);

$app->get('/logout', function ($request, $response, $args) {

    $controller = new \App\Controller\LoginController();
    $controller->logoutAction();

});

$app->get('/ws/produtos', function ($request, $response, $args) {
    $controller = new \App\Controller\ProdutoWsController();
    $controller->listarAction();
});




