<?php

namespace App\Dao;

use App\Conexao;
use App\Vo\Produto;
use InvalidArgumentException;

class ProdutoDao {

  public function ativar(Produto $produto) {

    // Validacoes

    // Verificar se preco no BD > 0
    $produtoBd = $this->selecionarPorId($produto->getIdproduto());
    if ($produtoBd->getPreco() <= 0) {
      throw new Exception("Preço deve ser maior que zero");
    }

    $produto->setStatus(Produto::ATIVO);

    $sql = "UPDATE produto SET
      status = :status
    WHERE idproduto = :idproduto";

    $con = Conexao::getConexao();

    $stmt = $con->prepare($sql);
    $stmt->bindValue(':status', $produto->getStatus());
    $stmt->bindValue(':idproduto', $produto->getIdproduto());
    $stmt->execute();

    return true;
  }

  public function create(Produto $produto) {

    // Validacoes
    if ($produto->getProduto() == ''){
      throw new InvalidArgumentException('Informe a descrição do produto');
    }

    if ($produto->getIdcategoria() <= 0){
      throw new InvalidArgumentException('Selecione a categoria');
    }

    $produto->setStatus(Produto::INATIVO);
    $produto->setSaldo(0);

    $sql = "INSERT INTO produto
      (produto, preco, status, idcategoria, saldo)
      VALUES
      (:produto, :preco, :status, :idcategoria, :saldo)";

    $con = Conexao::getConexao();

    $stmt = $con->prepare($sql);
    $stmt->bindValue(':produto', $produto->getProduto());
    $stmt->bindValue(':preco', $produto->getPreco());
    $stmt->bindValue(':status', $produto->getStatus());
    $stmt->bindValue(':idcategoria', $produto->getIdcategoria());
    $stmt->bindValue(':saldo', $produto->getSaldo());
    $stmt->execute();

    $produto->setIdproduto($con->lastInsertId());

    return true;

  }

  public function delete(Produto $produto) {

    return $this->deleteById($produto->getIdproduto());
    
  }

  public function deleteById($idproduto) {

    // Validacoes

    $sql = "DELETE FROM produto
    WHERE idproduto = :idproduto";

    $con = Conexao::getConexao();

    $stmt = $con->prepare($sql);
    $stmt->bindValue(':idproduto', $idproduto);
    $stmt->execute();

    return true;

  }

  public function desativar(Produto $produto) {

    // Validacoes

    $produto->setStatus(Produto::INATIVO);

    $sql = "UPDATE produto SET
      status = :status
    WHERE idproduto = :idproduto";

    $con = Conexao::getConexao();

    $stmt = $con->prepare($sql);
    $stmt->bindValue(':status', $produto->getStatus());
    $stmt->bindValue(':idproduto', $produto->getIdproduto());
    $stmt->execute();

    return true;
  }

  /**
   * @param $idproduto
   *
   * @return Produto
   */
  public function selecionarPorId($idproduto) {
    $sql = "Select * From produto
    WHERE idproduto = :idproduto";

    $con = Conexao::getConexao();

    $stmt = $con->prepare($sql);
    $stmt->bindValue(':idproduto', $idproduto);
    $stmt->execute();

    $prodBd = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($prodBd == null) {
      throw new InvalidArgumentException("Idproduto inexistente");
    }

    return Produto::fromArray($prodBd);
  }

  public function update(Produto $produto) {
    // Validacoes

    $sql = "UPDATE produto SET
      produto = :produto,
      preco = :preco,
      idcategoria = :idcategoria
    WHERE idproduto = :idproduto";

    $con = Conexao::getConexao();

    $stmt = $con->prepare($sql);
    $stmt->bindValue(':produto', $produto->getProduto());
    $stmt->bindValue(':preco', $produto->getPreco());
    $stmt->bindValue(':idcategoria', $produto->getIdcategoria());
    $stmt->bindValue(':idproduto', $produto->getIdproduto());
    $stmt->execute();

    return true;
  }

}