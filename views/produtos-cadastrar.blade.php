@extends('layouts.form')

@section('title', 'Cadastrar produto')
@section('fa-icon', 'headphones')

@section('form')

<form role="form" method="post" action="">

  <div class="form-group">
    <label for="fdescricao">Descrição</label>
    <input type="text" class="form-control" id="fdescricao"
           name="descricao" placeholder="Descrição do produto"
           value="{{ $descricao }}">
  </div>

  <div class="form-group">
    <label for="fpreco">Preço</label>
    <div class="input-group">
      <span class="input-group-addon">R$</span>
      <input type="text" class="form-control" id="fpreco" name="preco"
             placeholder="Preço" value="{{ $preco }}"
             required>
    </div>
  </div>

  <div class="form-group">
    <label for="fcategoria">Categoria</label>
    <select id="fcategoria" name="idcategoria" class="form-control"
            required>
      <option value="0">Selecione a categoria</option>

      @foreach($categorias as $categoria)
      <option value="{{ $categoria['idcategoria'] }}"

              @if ($idcategoria == $categoria['idcategoria'])
              selected
              @endif

              >{{ $categoria['categoria'] }}</option>
      @endforeach

    </select>
  </div>

  <button type="submit" class="btn btn-primary">Cadastrar</button>
  <button type="reset" class="btn btn-danger">Cancelar</button>
</form>

@endsection