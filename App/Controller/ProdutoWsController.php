<?php
namespace App\Controller;

use App\Conexao;
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

        header('Contet-type: application/json; charset=utf-8');
        echo json_encode($produtos);
    }
}