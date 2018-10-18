<?php

namespace App\Controller;

use App\Conexao;
use App\Dao\ProdutoDao;
use App\Vo\Produto;
use Exception;
use PDO;

class ProdutoWsController
{
    public function listarAction()
    {
        $idcategoria = 0;
        $q = '';
        if (isset($_GET['q'])) {
            $q = trim($_GET['q']);
        }
        if (isset($_GET['idcategoria'])) {
            $idcategoria = (int)$_GET['idcategoria'];
        }

        // Produtos
        $con = Conexao::getConexao();
        $sql = "Select produto.idproduto, produto, produto.status, categoria from produto inner join categoria on produto.idcategoria = categoria.idcategoria";
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

        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($produtos);
    }

    public function cadastrarAction()
    {
        $msg = array();
        $descricao = '';
        $preco = '';
        $idcategoria = 0;


        // Pegar informações
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $idcategoria = (int)$_POST['idcategoria'];

        $produto = new Produto();
        $produto->setProduto($descricao);
        $produto->setPreco($preco);
        $produto->setIdcategoria($idcategoria);

        $produtoDao = new ProdutoDao();
        header("Content-Type: application/json; charset=utf-8");

        try {
            $produtoDao->create($produto);


            echo json_encode(array(
                'idproduto' => $produto->getIdproduto(),
                'descricao' => $produto->getProduto(),
                'preco' => $produto->getPreco(),
                'idcategoria' => $produto->getIdcategoria()
            ));

        } catch (Exception $e) {
            echo json_encode(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function editarAction($idproduto)
    {
        $msg = array();
        $descricao = '';
        $preco = '';
        $idcategoria = 0;

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

//        header("Content-Type: application/json; charset=utf-8");
        header('Content-Type: application/json');
        try {

            $produtoDao->update($produto);

            echo json_encode(array(
                'idproduto' => $produto->getIdproduto(),
                'descricao' => $produto->getProduto(),
                'preco' => $produto->getPreco(),
                'idcategoria' => $produto->getIdcategoria()
            ));

        } catch (Exception $e) {
            echo json_encode(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function excluirAction ($idproduto) {
        $produtoDao = new ProdutoDao();
        $produtoDao->deleteById($idproduto);
    }

}