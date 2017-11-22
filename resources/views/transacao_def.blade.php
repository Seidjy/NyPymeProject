@extends('app')

@section('conteudo')
    <h2 class="titulo">Creditar</h2>

    <form action="" method="POST" role="form" class="fformularios">
        <div class="form-group form-contact">
            <input type="text" class="form-control" id="" placeholder="CPF Cliente" required="required">

            <input type="number" class="form-control" id="" placeholder="Compra" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection