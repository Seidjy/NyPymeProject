@extends('app')

@section('conteudo')
    <h2 class="titulo">Criar Conquista</h2>

    <form action="{{ route('goals.store') }}" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
            <label>Nome da conquista</label>
            <input name="name" type="text" class="form-control" id="" placeholder="Nome da Conquista" required="required">
            <label>Regra para conquistar</label>
            <select name="idRuleToAchieve" id="input" class="form-control" required="required">
            	@foreach ($achieves as $achieve)
                    <option value="{{ $achieve->id}}">{{ $achieve->name}}</option>
                @endforeach
            </select>
            <label>Regras para limitar</label>
            <select name="idRuleToRestrict" id="input" class="form-control" required="required">
            	@foreach ($restricts as $restrict)
                    <option value="{{ $restrict->id}}">{{ $restrict->name}}</option>
                @endforeach
            </select>
            <label>Regras de premiação</label>
            <select name="idRuleToAward" id="input" class="form-control" required="required">
                @foreach ($awards as $award)
                    <option value="{{ $award->id}}">{{ $award->name}}</option>
                @endforeach
            </select>
           
        </div>
       <button type="submit" class="btn btn-primary btn-contact btn-block">Cadastrar</button>
        </form>
         
@endsection