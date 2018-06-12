@extends('app')

@section('conteudo')
    <h2 class="titulo">Usuários bloqueados</h2> 

<div class="container">
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Email</th>
          <th>Nome</th>
          <th>CNPJ</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($logs as $log) {
            ?>
            <tr>
              <th>{{$log->id}}</th>
              <td>{{$log->email}}</td>
              <td>{{$log->name}}</td>
              <td>{{$log->cnpj}}</td>
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