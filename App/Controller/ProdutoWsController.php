<?php
/**
 * Created by PhpStorm.
 * User: alisson
 * Date: 16/10/18
 * Time: 21:52
 */

namespace App\Controller;


use App\Conexao;
use App\Vo\Produto;
use App\Dao\ProdutoDao;
use PDO;
use Slim\Http\Request;
use Slim\Http\Response;

class ProdutoWsController extends WsController
{

  public function listarAction(Request $request, Response $response, $args)
  {

    $idcategoria = 0;

    $q = '';
    if (isset($_GET['q'])) {
      $q = trim($_GET['q']);
    }
    if (isset($_GET['idcategoria'])) {
      $idcategoria = (int)$_GET['idcategoria'];
    }

    $con = Conexao::getConexao();

    // Produtos
    $sql
      = "Select produto.idproduto, produto, produto.status, categoria from produto inner join categoria on produto.idcategoria = categoria.idcategoria";
    $array = array();
    if ($q != '') {
      $array[] = "(produto like '%$q%')";
    }
    if ($idcategoria > 0) {
      $array[] = "(categoria.idcategoria = $idcategoria)";
    }
    if ($array) {
      $sql .= " Where " . join(' or ', $array);
    }
    $produtos = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return $this->response($response, $produtos);
  }

  public function cadastrarAction(Request $request, Response $response, $args)
  {

    $msg = array();

    // Pegar informações
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $idcategoria = (int)$_POST['idcategoria'];

    $produto = new Produto();
    $produto->setProduto($descricao);
    $produto->setPreco($preco);
    $produto->setIdcategoria($idcategoria);

    $produtoDao = new ProdutoDao();

    $produtoDao->create($produto);

    return $this->response($response, array(
      'idproduto' => $produto->getIdproduto(),
      'descricao' => $produto->getProduto(),
      'preco' => $produto->getPreco(),
      'idcategoria' => $produto->getIdcategoria()
    ));

  }

  public function editarAction(Request $request, Response $response, $args)
  {

    $idproduto = $args['id'];

    // Pegar informações
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $idcategoria = (int)$_POST['idcategoria'];

    $produto = new Produto();
    $produto->setIdproduto($idproduto);
    $produto->setProduto($descricao);
    $produto->setPreco($preco);
    $produto->setIdcategoria($idcategoria);

    $produtoDao = new ProdutoDao();

    $produtoDao->update($produto);

    return $this->response($response, array(
      'idproduto' => $produto->getIdproduto(),
      'descricao' => $produto->getProduto(),
      'preco' => $produto->getPreco(),
      'idcategoria' => $produto->getIdcategoria()
    ));

  }

  public function excluirAction (Request $request, Response $response, $args)
  {

    $idproduto = $args['id'];

    $produtoDao = new ProdutoDao();
    $produtoDao->deleteById($idproduto);

    return $this->response($response, []);

  }

}




