@extends('app')

@section('conteudo')
    <h2 class="titulo">Logar</h2>
    <form class="fformularios" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group form-contact">
            <label for="email" class="col-md-4 control-label">Email</label>

            <input id="email" type="email" class="form-control" name="email" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Senha</label>
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Relembrar
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-contact btn-block">
                Login
            </button>
        </div>
    </form>

@endsection
