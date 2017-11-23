@extends('app')

@section('conteudo')
	    <h2 class="titulo">Prêmios</h2>

	<?php //$eventos = array(); ?>

@foreach ($prizes as $prize)
	    <ul class="list-group margem">
	  		<li class="list-group-item"><span class="badge even">
	  			{{ $prize->price }} Pontos
	  		</span>{{ $prize->name }}</li>
		</ul>
@endforeach
	    <a href="{{ route('prizes.create') }}" class="btn btn-primary btn-contact btn-block">+</a>
@endsection