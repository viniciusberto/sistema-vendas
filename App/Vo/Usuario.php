<?php

namespace App\Vo;

class Usuario {

  private $idusuario;
  private $nome;
  private $email;
  private $senha;

  /**
   * @param $array
   *
   * @return Produto
   */
  public static function fromArray($array) {
    $usuario = new Usuario();
    $usuario->setIdusuario($array['idusuario']);
    $usuario->setNome($array['nome']);
    $usuario->setEmail($array['email']);
    $usuario->setSenha($array['senha']);

    return $usuario;
  }

  function getIdusuario() {
    return $this->idusuario;
  }

  function getNome() {
    return $this->nome;
  }

  function getEmail() {
    return $this->email;
  }

  function getSenha() {
    return $this->senha;
  }

  function setIdusuario($idusuario) {
    $this->idusuario = $idusuario;
  }

  function setNome($nome) {
    $this->nome = $nome;
  }

  function setEmail($email) {
    $this->email = $email;
  }

  function setSenha($senha) {
    $this->senha = $senha;
  }



}