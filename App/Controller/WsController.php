<?php

namespace App\Controller;

use Slim\Http\Response;

abstract class WsController
{

  /**
   * @param Response $response
   * @param          $data
   *
   * @return Response
   */
  protected function response(Response $response, $data)
  {
    return $response
      // ->withHeader("Content-Type", "application/json")
      ->withJson($data);
  }

}