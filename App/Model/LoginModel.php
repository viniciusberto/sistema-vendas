<?php

namespace App\Model;

use App\Conexao;
use App\Vo\Usuario;
use InvalidArgumentException;
use PDO;

class LoginModel {

  public function login(Usuario $usuario) {

    $senha = md5('abc' . $usuario->getSenha());

    $sql = "select idusuario, nome from usuario
        where (senha = :senha) and (email = :email)";

    $con = Conexao::getConexao();

    $stmt = $con->prepare($sql);
    $stmt->bindValue(':senha', $senha);
    $stmt->bindValue(':email', $usuario->getEmail());
    $stmt->execute();

    $usuarioBd = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioBd == null) {
      throw new InvalidArgumentException("Login e/ou senha incorretos");
    }

    $usuario->setIdusuario($usuarioBd['idusuario']);
    $usuario->setNome($usuarioBd['nome']);

    $_SESSION['logado'] = 1;
    $_SESSION['nome'] = $usuarioBd['nome'];
    $_SESSION['idusuario'] = $usuarioBd['idusuario'];

    return true;
  }

}
