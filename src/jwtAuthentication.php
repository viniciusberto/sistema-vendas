<?php

// https://github.com/tuupola/slim-jwt-auth
// https://tools.ietf.org/html/rfc7519
// https://www.sitepoint.com/php-authorization-jwt-json-web-tokens/

$app->add(new Tuupola\Middleware\JwtAuthentication([

  // "header" => "X-Token",

  "attribute" => "auth",

  "path" => ["/ws"],

  "ignore" => ["/ws/auth"],

  "secret" => JWT_SECRET,

  "error" => function ($response, $arguments) {
    $data["status"] = "error";
    $data["message"] = $arguments["message"];

    return $response->withJson($data)
      ->withHeader('Content-type', 'application/json');
  }

]));