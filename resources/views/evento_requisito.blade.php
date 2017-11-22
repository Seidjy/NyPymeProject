@extends('app')

@section('conteudo')
    <h2 class="titulo">Definir Requisito</h2>

    <form action="" method="POST" role="form" class="fformularios">
        <div class="form-group form-contact">
            <select name="" id="input" class="form-control" required="required">
                <option>Definir Requisito</option>
                <option value="">Requisito Um</option>
            </select>

            <input type="text" class="form-control" id="" placeholder="Requisito" required="required">

            <input type="number" class="form-control" id="" placeholder="Quantidade" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-contact btn-block">Confirmar</button>
    </form>
@endsection