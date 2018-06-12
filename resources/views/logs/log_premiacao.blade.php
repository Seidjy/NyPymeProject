@extends('app')

@section('conteudo')
    <h2 class="titulo">Log dos Prêmios</h2>  

<div class="container">
  <form action="/log/premios/data" method="POST" role="form">
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
            <td>{{$log->created_at}}</td>
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