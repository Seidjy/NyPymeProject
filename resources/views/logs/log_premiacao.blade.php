@extends('app')

@section('conteudo')
    <h2 class="titulo">Log dos Prêmios</h2>  

<div class="container">
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Usuário</th>
          <th>IP</th>
          <th>Ação</th>
          <th>Data</th>
          <th>Novo Nome</th>
          <th>Antigo Nome</th>
          <th>Novo Preço</th>
          <th>Antigo Preço</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($logs as $log) {
          ?>
          <tr>
            <th>{{$log->id}}</th>
            <td>{{$log->usuario}}</td>
            <td>{{$log->ip}}</td>
            <td>{{$log->action}}</td>
            <td>{{$log->novo_nome}}</td>
            <td>{{$log->antigo_nome}}</td>
            <td>{{$log->novo_preco}}</td>
            <td>{{$log->antigo_preco}}</td>
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