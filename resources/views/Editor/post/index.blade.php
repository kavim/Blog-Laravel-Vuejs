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
            @if (session('msg'))
                <div class="alert alert-success">
                    <i class="fa fa-check" aria-hidden="true"></i> <b> {{ session('msg') }} </b>
                </div>
            @endif

            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <b>POST</b>
                    <a class="btn btn-success" href="{{ route('post.create') }}">Criar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">


                    @foreach ($posts as $post)

                    <h1>{{ $post->title }}</h1>
                    <p>{{ $post->description }}</p>
                    <p>{{ $post->content }}</p>
                    <p>{{ $post->subtitle }}</p>
                    <p>{{ $post->active }}</p>
                    <p>{{ $post->category_id }}</p>

                    @endforeach

                    <hr>

                    {{ $posts }}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
