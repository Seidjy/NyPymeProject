@extends('app')

@section('conteudo')
    <h2 class="titulo">Log dos Participantes</h2> 

<div class="container">
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
              <td>{{$log->novo_cpf}}</td>
              <td>{{$log->antigo_cpf}}</td>
              <td>{{$log->nova_pontuacao}}</td>
              <td>{{$log->antiga_pontuacao}}</td>
              <td>{{$log->usuario}}</td>
              <td>{{$log->ip}}</td>
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