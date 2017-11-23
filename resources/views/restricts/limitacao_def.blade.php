@extends('app')

@section('conteudo')
    <h2 class="titulo">Definir a Limitação para uso da Pontuação</h2>

    <form action="{{ route('restricts.store') }}" method="POST" role="form" class="fformularios">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
        <label>Nome</label>
        	<input type="text" class="form-control" name="name"required="required">
        	<select id="input" name="idTypeRestrict" class="form-control" required="required" placeholder="Definir Limitação">
        		@foreach ($restricts as $restrict)
				    <option value="{{ $restrict->id}}">{{ $restrict->name}}</option>
				@endforeach
            </select>
            <label>Intervalo</label>
            <input type="number" min="1" class="form-control" name="amount" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection