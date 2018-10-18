<?php

namespace App\Controller;

use App\Model\LoginModel;
use App\Vo\Usuario;
use InvalidArgumentException;

class LoginController extends Controller {

  public function __construct() {
    
  }

  public function loginAction() {
    $msg = array();

    if ($_POST) {
      $usuario = new Usuario();
      $usuario->setEmail($_POST['email']);
      $usuario->setSenha($_POST['senha']);

      $model = new LoginModel();

      try {
        $model->login($usuario);
        header('location:' . HTML_BASE);
        exit;
      } catch (InvalidArgumentException $e) {
        $msg[] = $e->getMessage();
      }
    }

    $view = $this->view();
    echo $view->render('login', array(
        'msg' => $msg
    ));
  }

  public function logoutAction() {
    session_destroy();
    header('location:./login');
    exit;
  }

}
