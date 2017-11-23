@extends('app')

@section('conteudo')
    <h2 class="titulo">Definir Recompensa</h2>

    <form action="{{ route('prizes.store') }}" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
            <label>Nome</label>
            <input name="name" type="text" class="form-control" required="required">
            <label>Preço em pontos</label>
            <input name="price" type="number" class="form-control" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection