@extends('app')

@section('conteudo')
    <h2 class="titulo">Debitar</h2>

    <form action="/deal/storeDebit" method="POST" role="form" class="fformularios">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="form-group form-contact">
            <label>CPF do Participante</label>
            <input name="cpf" type="text" class="form-control" id="" placeholder="CPF Cliente" required="required">
            <label>Prêmio</label>
            <select name="idPrize" id="input" class="form-control" required="required">
                @foreach ($prizes as $prize)
                    <option value="{{ $prize->id}}">{{ $prize->name}} R$ {{ $prize->price}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection