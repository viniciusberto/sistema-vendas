@extends('layouts.app2')

@section('title', 'Vendys')

@section('content')

<div class="jumbotron">
  <div class="container">
    <h1>Vendys</h1>
    <p>Bem vindo <?= $_SESSION['nome'] ?></p>
    <p>
    <div class="btn-group">
      <a class="btn btn-primary btn-lg" role="button" href="clientes.php">
        <i class="fa fa-heart fa-lg"></i> Clientes
      </a>
    </div>

    <div class="btn-group">
      <a class="btn btn-primary btn-lg" role="button" href="/produtos">
        <i class="fa fa-headphones fa-lg"></i>  Produtos
      </a>
    </div>

    <div class="btn-group">
      <a class="btn btn-primary btn-lg" role="button" href="vendas.php">
        <i class="fa fa-dashboard fa-lg"></i>  Vendas
      </a>
    </div>

    <div class="btn-group">
      <a class="btn btn-primary btn-lg" role="button" href="usuarios.php">
        <i class="fa fa-user fa-lg"></i>  Usuários
      </a>
    </div>

    <!--<div class="btn-group">
      <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bar-chart-o fa-lg"></i>  Relatórios <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="rel-clientes.php">Clientes</a></li>
        <li><a href="rel-produtos.php">Produtos</a></li>
        <li><a href="rel-vendas.php">Vendas</a></li>
      </ul>
    </div>-->
    </p>
  </div>
</div>

@endsection