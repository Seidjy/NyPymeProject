@extends('app')

@section('conteudo')
    <h2 class="titulo">Definir Recompensa</h2>

    <form action="/customer/{{$customer->id}}/update" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
       <div class="form-group form-contact">
            <label>CPF</label>
            <input name="cpf" type="text" class="form-control" required="required" value="{{$customer->cpf}}">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection