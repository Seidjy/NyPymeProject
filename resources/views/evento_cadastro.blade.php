@extends('app')

@section('conteudo')
    <h2 class="titulo">Criar Eventos</h2>

    <form action="" method="POST" role="form" class="fformularios">
        <div class="form-group form-contact">
            <input type="text" class="form-control" id="" placeholder="Nome do Evento" required="required">

            <select name="" id="input" class="form-control" required="required">
            	<option>Requisito do Evento</option>
            	<option value="">Requisito Um</option>
            </select>

            <select name="" id="input" class="form-control" required="required">
            	<option>Regra de Limitação</option>
            	<option value="">Regra de Um</option>
            </select>

            <input type="number" class="form-control" id="" placeholder="Número de Pontos" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Cadastrar</button>
    </form>
@endsection