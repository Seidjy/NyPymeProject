@extends('app')

@section('conteudo')
	    <h2 class="titulo">Lista de Clientes</h2>

	<?php //$clientes = array(); ?>

@foreach ($clientes as $cliente)
	    <ul class="list-group margem">
	  		<li class="list-group-item"><span class="badge client">{{ $cliente->points }}
	  		</span>{{ $cliente->cpf }}</li>
		</ul>
@endforeach
@endsection