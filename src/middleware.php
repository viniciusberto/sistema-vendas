<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// require DIRETORIO . '/src/httpBasicAuthentication.php';

require DIRETORIO . '/src/jwtAuthentication.php';

$c = $app->getContainer();
$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $c['response']->withStatus(500)
            ->withJson($exception->getMessage());
    };
};