@extends('app')

@section('conteudo')
	    <h2 class="titulo">Lista de Clientes</h2>

	<?php //$clientes = array(); ?>

@foreach ($clientes as $cliente)
	    <ul class="list-group margem">
	  		<li class="list-group-item"><span class="badge client">{{ $cliente->points }}
	  		</span>{{ $cliente->cpf }}</li>
	  		<a href="/participant/{{$cliente->id}}/editar">Editar</a>
		</ul>
@endforeach
		<a href="/deal/debit" class="btn btn-primary btn-contact btn-block">Premiar</a>
@endsection