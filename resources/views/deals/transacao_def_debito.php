@extends('app')

@section('conteudo')
    <h2 class="titulo">Debitar</h2>

    <form action="{{ route('deal.store') }}" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
            <label>CPF do Participante</label>
            <input name="cpf" type="text" class="form-control" id="" placeholder="CPF Cliente" required="required">
            <label>Prêmio</label>
            <select name="idPrize" id="input" class="form-control" required="required">
                @foreach ($awards as $award)
                    <option value="{{ $award->id}}">{{ $award->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection