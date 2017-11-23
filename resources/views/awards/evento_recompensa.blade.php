@extends('app')

@section('conteudo')
    <h2 class="titulo">Definir Recompensa</h2>

    <form action="{{ route('awards.store') }}" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
            <label>Nome da Recompensa</label>
            <input name="name" type="text" class="form-control" id="" required="required">
            <label>Tipo de Prêmio</label>
            <select name="idTypeAward" id="input" class="form-control" required="required">
                @foreach ($awards as $award)
                    <option value="{{ $award->id}}">{{ $award->name}}</option>
                @endforeach
            </select>
            <label>Quantidade</label>
            <input name="amount" min="1" type="number" class="form-control" id="" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection