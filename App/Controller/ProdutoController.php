<?php

namespace App\Controller;

use App\Conexao;
use App\Dao\ProdutoDao;
use App\Vo\Produto;
use Exception;
use PDO;

class ProdutoController extends Controller {

  public function __construct()
  {
    $this->protege();
  }

  public function cadastrarAction() {

    $msg = array();
    $descricao = '';
    $preco = '';
    $idcategoria = 0;

    if ($_POST) {
      // Pegar informações
      $descricao = $_POST['descricao'];
      $preco = $_POST['preco'];
      $idcategoria = (int)$_POST['idcategoria'];

      $produto = new Produto();
      $produto->setProduto($descricao);
      $produto->setPreco($preco);
      $produto->setIdcategoria($idcategoria);

      $produtoDao = new ProdutoDao();

      try {
        $produtoDao->create($produto);

        $url = 'produtos-editar.php?idproduto=' . $produto->getIdproduto();
        $mensagem = 'Produto cadastrado!';

        javascriptAlertFim($mensagem, $url);
      } catch (Exception $e) {
        $msg[] = $e->getMessage();
      }

    }

    $sql = 'Select idcategoria,categoria from categoria where (status = 1)';
    $con = Conexao::getConexao();
    $consulta = $con->query($sql)->fetchAll();

    $view = $this->view();
    echo $view->render('produtos-cadastrar', array(
      'categorias' => $consulta,
      'idcategoria' => $idcategoria,
      'descricao' => $descricao,
      'preco' => $preco,
      'msg' => $msg
    ));

  }

  public function listarAction() {

    $idcategoria = 0;

    $q ='';
    if(isset($_GET['q'])){
      $q =trim($_GET['q']);
    }
    if(isset($_GET['idcategoria'])){
      $idcategoria = (int) $_GET['idcategoria'];
    }

    // Selecionar categorias
    $sql = 'Select idcategoria,categoria from categoria where (status = 1)';
    $con = Conexao::getConexao();
    $categorias = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // Produtos
    $sql = "Select produto.idproduto, produto, produto.status, categoria from produto inner join categoria on produto.idcategoria = categoria.idcategoria";
    $array = array();
    if($q != ''){
      $array[] = "(produto like '%$q%')";
    }
    if($idcategoria > 0){
      $array[] = "(categoria.idcategoria = $idcategoria)";
    }
    if($array){
      $sql .= " Where ".join(' or ',$array);
    }
    $produtos = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // require VIEWS . '/produtos.php';
    $view = $this->view();
    echo $view->render('produtos', array(
      'idcategoria' => $idcategoria,
      'q' => $q,
      'categorias' => $categorias,
      'produtos' => $produtos
    ));
  }

  public function editarAction( $idproduto ) {
    $msg = array();

    $sql = "Select * From produto
Where (idproduto = $idproduto)";

    $con = Conexao::getConexao();
    $r = $con->query($sql);

    if ( ! $produto = $r->fetch() ) {
      $url = 'produtos';
      $msg = "Registro inexistente.";
      javascriptAlertFim($msg, $url);
    }

    $descricao = $produto['produto'];
    $preco = $produto['preco'];
    $idcategoria = $produto['idcategoria'];
    $saldo = $produto['saldo'];
    $ativo = $produto['status'];

    if ($_POST) {
      // Pegar informações
      $descricao = $_POST['descricao'];
      $preco = $_POST['preco'];
      $saldo = (int) $_POST['saldo'];
      $idcategoria = (int) $_POST['idcategoria'];

      $produto = new Produto();
      $produto->setIdproduto($idproduto);
      $produto->setProduto($descricao);
      $produto->setPreco($preco);
      $produto->setIdcategoria($idcategoria);

      $produtoDao = new ProdutoDao();

      try {
        $produtoDao->update($produto);

        javascriptAlertFim('Produto atualizado', 'produtos.php');
      } catch (Exception $e) {
        $msg[] = $e->getMessage();
      }

    }

    $sql = 'Select idcategoria,categoria from categoria where (status = 1)';
    $categorias = $con->query($sql)->fetchAll();

    $view = $this->view();
    echo $view->render('produtos-editar', array(
      'categorias' => $categorias,
      'idproduto' => $idproduto,
      'descricao' => $descricao,
      'preco' => $preco,
      'idcategoria' => $idcategoria,
      'msg' => $msg,
      'ativo' => $ativo
    ));

  }

  public function excluirAction ( $idproduto ) {

    $produtoDao = new ProdutoDao();
    $produtoDao->deleteById($idproduto);

  }

}