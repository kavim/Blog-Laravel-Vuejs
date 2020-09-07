@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> POST</h1>
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
        <div class="tile-body">
            <div class="row mt-4">
                <div class="col-lg-10">
                    <h3 class="page-header"> Novo post </h3>
                </div>
                <div class="col-lg-2">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block"> <i class="fa fa-arrow-left"></i> Voltar </a>
                </div>
            </div>

            <div class="row">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data" class="col-12">
                    @csrf

                    @include('Editor.post._form')

                    <div class="col-12 m-2">
                        <button type="submit" class="btn btn-success btn-block">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
