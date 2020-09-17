@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> INICIAL</h1>
      <p>Talvez alguns numeros aqui</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">caminho de pão</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body text-center">
            <h1 class="text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></h1>
            <h1>Acesso negado!</h1>

            <a class="btn btn-outline-dark" href="/editor">Voltar</a>
        </div>
      </div>
    </div>
</div>
@endsection
