@extends('app')

@section('conteudo')
    <h2 class="titulo">Creditar</h2>

    <form action="{{ route('deal.store') }}" method="POST" role="form" class="fformularios">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
        	<label>CPF do Participante</label>
            <input name="cpf" type="text" class="form-control" id="" placeholder="CPF Cliente" required="required">
            <label>Valor da Compra</label>
            <input name="amount" type="number" class="form-control" id="" placeholder="Compra" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection