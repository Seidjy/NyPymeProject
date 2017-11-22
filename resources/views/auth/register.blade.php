@extends('app')

@section('conteudo')

<h2 class="titulo">Registrar</h2>

<form class="fformularios" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="form-group form-contact{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nome</label>
            <input  type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
    </div>

    <div class="form-group form-contact{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="cnpj" class="col-md-4 control-label">CNPJ</label>
        <input  type="number" maxlength="14" class="form-control" name="cnpj" value="{{ old('cnpj') }}" required>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('cnpj') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group form-contact{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail</label>
        <input  type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group form-contact{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Senha</label>

        <input  type="password" class="form-control" name="password" required>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group form-contact">
        <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha</label>
            <input  type="password" class="form-control" name="password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary btn-contact btn-block">Registrar</button>
</form>
@endsection
