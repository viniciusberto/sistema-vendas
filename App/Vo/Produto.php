<?php

namespace App\Vo;

class Produto {

  const INATIVO = 0;
  const ATIVO = 1;

  private $idproduto;
  private $produto;
  private $preco;
  private $status;
  private $idcategoria;
  private $saldo;

  /**
   * @param $array
   *
   * @return Produto
   */
  public static function fromArray($array) {
    $produto = new Produto();
    $produto->setIdproduto($array['idproduto']);
    $produto->setProduto($array['produto']);
    $produto->setPreco($array['preco']);
    $produto->setStatus($array['status']);
    $produto->setIdcategoria($array['idcategoria']);
    $produto->setSaldo($array['saldo']);

    return $produto;
  }

  /**
   * @return mixed
   */
  public function getIdproduto()
  {
    return $this->idproduto;
  }

  /**
   * @param mixed $idproduto
   */
  public function setIdproduto($idproduto)
  {
    $this->idproduto = $idproduto;
  }

  /**
   * @return mixed
   */
  public function getProduto()
  {
    return $this->produto;
  }

  /**
   * @param mixed $produto
   */
  public function setProduto($produto)
  {
    $this->produto = $produto;
  }

  /**
   * @return mixed
   */
  public function getPreco()
  {
    return $this->preco;
  }

  /**
   * @param mixed $preco
   */
  public function setPreco($preco)
  {
    $this->preco = $preco;
  }

  /**
   * @return mixed
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * @param mixed $status
   */
  public function setStatus($status)
  {
    $this->status = $status;
  }

  /**
   * @return mixed
   */
  public function getIdcategoria()
  {
    return $this->idcategoria;
  }

  /**
   * @param mixed $idcategoria
   */
  public function setIdcategoria($idcategoria)
  {
    $this->idcategoria = $idcategoria;
  }

  /**
   * @return mixed
   */
  public function getSaldo()
  {
    return $this->saldo;
  }

  /**
   * @param mixed $saldo
   */
  public function setSaldo($saldo)
  {
    $this->saldo = $saldo;
  }



}