<?php

// https://github.com/tuupola/slim-basic-auth
// https://medium.com/@fidelissauro/slim-framework-criando-microservices-07-implementando-seguran%C3%A7a-b%C3%A1sica-com-http-auth-e-proxy-ed6dd6d517f4

$app->add(new Tuupola\Middleware\HttpBasicAuthentication([

  "realm" => "Protected",

  /**
   * Usuários existentes
   */
  "users" => [
    "root" => "toor",
    "admin" => "admin",
  ],

  /**
   * Classe de autenticacao
   */
  // "authenticator" => new BasicAuthenticator;

  /**
   * Blacklist - Deixa todas liberadas e só protege as dentro do array
   */
  "path" => ["/ws"],

  /**
   * Whitelist - Protege todas as rotas e só libera as de dentro do array
   */
  //"passthrough" => ["/auth/liberada", "/admin/ping"],
]));