@extends('app')

@section('conteudo')
    <h2 class="titulo">Definir Recompensa</h2>

    <form action="/prize/{{$prize->id}}/update" method="POST" role="form" class="fformularios">
       <div class="form-group form-contact">
            <label>Nome</label>
            <input name="name" type="text" class="form-control" required="required" value="{{$prize->name}}">
            <label>Preço em pontos</label>
            <input name="price" type="text" pattern="[0-9]*" class="form-control" required="required" value="{{$prize->price}}">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection