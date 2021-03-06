@extends('app')

@section('conteudo')
    <h2 class="titulo">Log Login</h2> 

<div class="container">
<p class="botao"> <a href="/log/login/sucesso" type="button" class="btn btn-success">Filtrar por Sucesso</a> <a href="/log/login/insucesso" type="button" class="btn btn-danger">Filtrar por insucesso</a>

  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>IP</th>
          <th>Data</th>
          <th>Login Nome</th>
          <th>Login Senha</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($logs as $log) {
            ?>
            <tr>
              <th>{{$log->id}}</th>
              <td>{{$log->ip}}</td>
              <td>{{$log->created_at}}</td>
              <td>{{$log->user}}</td>
              <td>{{$log->password}}</td>
              <td>{{$log->action}}</td>
            </tr>
            <?php
          }
         ?>
      </tbody>
    </table>
    </div>
</div>

<div class="container">

@endsection