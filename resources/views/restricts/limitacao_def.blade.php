@extends('app')

@section('conteudo')
    <h2 class="titulo">Definir Limitação</h2>

    <form action="{{ route('restricts.store') }}" method="POST" role="form" class="fformularios">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
        	<input type="text" class="form-control" name="name" placeholder="Nome" required="required">
        	<select id="input" name="idTypeRestrict" class="form-control" required="required" placeholder="Definir Limitação">
        		@foreach ($restricts as $restrict)
				    <option value="{{ $restrict->id}}">{{ $restrict->name}}</option>
				@endforeach
            </select>
            <input type="number" class="form-control" name="amount" placeholder="Intervalo" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection