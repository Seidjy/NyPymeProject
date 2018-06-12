@extends('app')

@section('conteudo')
    <h2 class="titulo">Log dos Participantes</h2> 

<div class="container">
  <form action="/log/participant/data"  method="POST" role="form">
     <input type="hidden" name="_token" value="{{ csrf_token() }}" >
     <h4>Filtro de Pesquisa</h4>
 <p class="datetime"> <input type="datetime-local" name="first_date">

  <p class="datetime1"> <input type="datetime-local" name="last_date">
  <input type="submit" class="btn btn-info" value="Filtrar">
</form>

  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>IP</th>
          <th>Usuário</th>
          <th>Data</th>
          <th>Novo CPF</th>
          <th>Antigo CPF</th>
          <th>Nova Pontuação</th>
          <th>Antiga Pontuação</th>
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
              <td>{{$log->usuario}}</td>
              <td>{{$log->created_at}}</td>
              <td>{{$log->novo_cpf}}</td>
              <td>{{$log->antigo_cpf}}</td>
              <td>{{$log->nova_pontuacao}}</td>
              <td>{{$log->antiga_pontuacao}}</td>
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