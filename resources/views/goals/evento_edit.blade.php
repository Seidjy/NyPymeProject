@extends('app')

@section('conteudo')
    <h2 class="titulo">Cadastrar Conquista de Pontuação</h2>

    <form action="/goals/{$goal->id}/update" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
            <label>Nome da Conquista</label>
            <input name="name" type="text" class="form-control" id="" required="required" value="{{$goal->name}}">
            <label>Regra para Conquistar</label>
            <select name="idRuleToAchieve" id="input" class="form-control" required="required">
            	
                @foreach ($achieves as $achieve)
                <?php 
                if ($achieve->id == $goal->idRuleToRestrict) {
                    ?>
                    <option value="{{ $achieve->id}}">{{ $achieve->name}}</option>
                    <?php 
                }else { ?>

                    <option value="{{ $achieve->id}}">{{ $achieve->name}}</option>
                    <?php 
                } ?>
                @endforeach

            </select>
            <label>Regras para Limitar</label>
            <select name="idRuleToRestrict" id="input" class="form-control" required="required">
                @foreach ($restricts as $restrict)
                <?php 
                if ($restrict->id == $goal->idRuleToRestrict) {
                    ?>
                    <option value="{{ $restrict->id}}" selected>{{ $restrict->name}}</option>
                    <?php 
                }else { ?>

                    <option value="{{ $restrict->id}}">{{ $restrict->name}}</option>
                    <?php 
                } ?>
                @endforeach
            </select>
            <label>Regras de Premiação</label>
            <select name="idRuleToAward" id="input" class="form-control" required="required">
                @foreach ($awards as $award)
                <?php 
                if ($award->id == $goal->idRuleToAward) {
                    ?>
                    <option value="{{ $award->id}}" selected>{{ $award->name}}</option>
                    <?php 
                }else { ?>

                    <option value="{{ $award->id}}">{{ $award->name}}</option>
                    <?php 
                } ?>
                @endforeach
            </select>
           
        </div>
       <button type="submit" class="btn btn-primary btn-contact btn-block">Cadastrar</button>
        </form>
         
@endsection