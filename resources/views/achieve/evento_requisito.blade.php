@extends('app')

@section('conteudo')
    <h2 class="titulo">Cadastrar Regras para Pontuação</h2>

    <form action="{{ route('achieve.store') }}" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
            <label>Nome da Conquista</label>
            <input name="name" type="text" class="form-control" id="" required="required">
            <label>Tipo de Conquista</label>
            <select name="idTypeAchieve" id="input" class="form-control" required="required">
                @foreach ($achieves as $achieve)
                    <option value="{{ $achieve->id}}">{{ $achieve->name}}</option>
                @endforeach
            </select>
            <label>Acumulação</label>
            <select id="input" type="number" name="gather" class="form-control" required="required" placeholder="Definir Limitação">
                    <option value="0">Não Acumulativo</option>
                    <option value="1">Acumulativo</option>
            </select>
            <label>Quantidade</label>
            <input name="amount" type="number" min="1" class="form-control" id="" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection