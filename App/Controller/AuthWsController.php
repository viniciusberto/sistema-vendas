<?php

namespace App\Controller;

use App\Model\LoginModel;
use App\Vo\Usuario;
use DateTime;
use Firebase\JWT\JWT;
use Slim\Http\Request;
use Slim\Http\Response;


class AuthWsController extends WsController
{

  /**
   * AuthWsController constructor.
   */
  public function __construct()
  {
  }

  public function authAction(Request $request, Response $response, $args)
  {

    $usuario = new Usuario();
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);

    $model = new LoginModel();
    $model->login($usuario);

    $issuedAt = new DateTime();
    $notBefore = new DateTime("now +10 seconds");
    $expire = new DateTime("now +2 hours");
    $server = $request->getServerParams();

    // $jti = base64_encode(mcrypt_create_iv(32));
    $jti = base64_encode(random_bytes(32));

    $payload = [
      "iat" => $issuedAt->getTimeStamp(), // Issued At
      'nbf'  => $notBefore->getTimestamp(), // Not before
      "exp" => $expire->getTimeStamp(), // Expiration Time
      "jti" => $jti, // JWT ID
      'iss'  => $server['SERVER_NAME'], // Issuer

      "data" => [
        'id' => (int) $usuario->getIdusuario(),
        'email' => $usuario->getEmail(),
        'nome' => $usuario->getNome(),
      ]
    ];

    $secret = JWT_SECRET;

    $token = JWT::encode($payload, $secret, 'HS512');

    $data = [];
    $data["token"] = $token;
    $data["expires"] = $expire->getTimeStamp();

    return $this->response($response, $data)
      ->withStatus(201);

  }
}