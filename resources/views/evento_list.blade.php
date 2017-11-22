@extends('app')

@section('conteudo')
	    <h2 class="titulo">Eventos</h2>

	<?php //$eventos = array(); ?>

{{--@foreach ($eventos as $evento)--}}
	    <ul class="list-group margem">
	  		<li class="list-group-item"><span class="badge even">
	  			<i class="fa fa-check-circle eventos-list" aria-hidden="true"></i>
	  		</span>Evento {{--{{ $evento->id }}--}}</li>
		</ul>
{{--@endforeach--}}
@endsection