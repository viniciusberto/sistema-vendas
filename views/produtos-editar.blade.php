@extends('layouts.form')

@section('title', 'Editar produtos')
@section('fa-icon', 'headphones')

@section('form')
<form role="form" method="post" action="">

  <input type="hidden" name="idproduto" value="{{ $idproduto }}">

  <div class="form-group">
    <label for="fdescricao">Descrição</label>
    <input type="text" class="form-control" id="fdescricao" name="descricao" placeholder="Descrição do produto" value="{{ $descricao }}" required>
  </div>

  <div class="form-group">
    <label for="fpreco">Preço</label>
    <div class="input-group">
      <span class="input-group-addon">R$</span>
      <input type="text" class="form-control" id="fpreco" name="preco" placeholder="Preço" value="{{ $preco }}" required>
    </div>
  </div>

  <div class="form-group">
    <label for="fcategoria">Categoria</label>
    <select id="fcategoria" name="idcategoria" class="form-control" required>
      <option value="0">Selecione a categoria</option>

      <?php
      foreach ($categorias as $r) {
        ?>

        <option value="{{ $r['idcategoria'] }}"

                @if ($idcategoria == $r['idcategoria'])
                selected
                @endif

                >{{ $r['categoria'] }}</option>

      <?php } ?>

    </select>
  </div>

  <div class="form-group">
    <label for="fsaldo">Saldo</label>
    <input type="number" class="form-control" id="fsaldo" name="saldo" placeholder="Estoque" value="{{ $saldo }}" required>
  </div>

  <div class="checkbox">
    <label for="fativo">
      <input type="checkbox" name="ativo" id="fativo" <?php if ($ativo == 1) { ?>checked<?php } ?>> Produto ativo
    </label>
  </div>

  <button type="submit" class="btn btn-primary">Salvar</button>
  <button type="reset" class="btn btn-danger">Cancelar</button>
</form>
@endsection