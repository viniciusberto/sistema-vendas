@extends('layouts.app3')

@section('title', 'Produtos')
@section('fa-icon', 'headphones')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Produtos</h3>
  </div>
  <div class="panel-body">
    <form class="form-inline" role="form" method="get" action="">
      <div class="form-group">
        <label class="sr-only" for="fq">Pesquisa</label>
        <select class="form-control" name="idcategoria">
          <option value="0">Categoria</option>

          @foreach ($categorias as $r)

          <option value="{{ $r['idcategoria'] }}"

                  @if ($idcategoria == $r['idcategoria'])
                  selected
                  @endif

                  >{{ $r['categoria'] }}</option>

          @endforeach

        </select>
        <input type="search" class="form-control" id="fq" name="q" placeholder="Pesquisa" value="{{ $q }}">
      </div>
      <button type="submit" class="btn btn-default">Pesquisar</button>
    </form>
  </div>

  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th></th>
        <th>Categoria</th>
        <th>Nome</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      @foreach ($produtos as $resultado)

      <tr>
        <td>{{ $resultado['idproduto'] }}</td>
        <td>

          @if($resultado['status'] == PRODUTO_ATIVO)
          <span class="label label-success">ativo</span>
          @else
          <span class="label label-warning">inativo</span>
          @endif

        </td>

        <td>{{ $resultado['categoria'] }}</td>
        <td>{{ $resultado['produto'] }}</td>

        <td>
          <a href="produtos-editar/{{ $resultado['idproduto'] }}" title="Editar produto"><i class="fa fa-edit fa-lg"></i></a>
          <a href="produtos-apagar/{{ $resultado['idproduto'] }}" title="Remover produto"><i class="fa fa-times fa-lg"></i></a>
        </td>
      </tr>

      @endforeach

    </tbody>
  </table>
</div>

@endsection