@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i>post</h1>
      {{-- <p>Talvez alguns numeros aqui</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/">Posts</a></li>
      <li class="breadcrumb-item">Editar</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
            <div class="row mt-4">
                <div class="col-lg-10">
                    <h3 class="page-header"> Editar </h3>
                </div>
                {{-- <div class="col-lg-2">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block"> <i class="fa fa-arrow-left"></i> Voltar </a>
                </div> --}}
            </div>

            <div class="row">

            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12 col-md-10 mx-auto">

                        <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data" class="col-12">
                            @csrf
                            @method('PUT')

                            @include('Editor.post._form')

                            <div class="tile-footer">
                                <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                                  </div>
                                </div>
                            </div>
                        </form>


                </div>

            </div>
        </div>
      </div>

    </div>
</div>
@endsection
