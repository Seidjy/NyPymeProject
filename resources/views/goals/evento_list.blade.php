@extends('app')

@section('conteudo')
	    <h2 class="titulo">Conquistas</h2>

	<?php //$eventos = array(); ?>

@foreach ($goals as $goal)
	    <ul class="list-group margem">
	  		<li class="list-group-item"><span class="badge even">
	  			<i class="fa fa-check-circle eventos-list" aria-hidden="true"></i>
	  		</span>{{ $goal->name }}</li>
	  		<a href="/goals/edit/{{ $goal->id }}">Editar</a>
		</ul>
@endforeach
	    <a href="{{ route('goals.create') }}" class="btn btn-primary btn-contact btn-block">+</a>
@endsection