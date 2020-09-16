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
            @if (session('erromsg'))
                <div class="alert alert-danger">
                    <i class="fa fa-check" aria-hidden="true"></i> <b> {{ session('msg') }} </b>
                </div>
            @endif

            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <b>POST</b>
                    <a class="btn btn-success" href="{{ route('post.create') }}">Criar</a>
                </div>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">capa</th>
                    <th scope="col">titulo</th>
                    <th scope="col">subtitulo</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td><img src="{{ $post->getCover($post->id) }}" width="100" alt=""></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->subtitle }}</td>
                            <td><a href="/editor/post/edit/{{ $post->id }}" >Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
              </table>


              {{ $posts->render() }}
            {{-- <div class="row">
                <div class="col-12">

                    @foreach ($posts as $post)

                    <h1>{{ $post->title }}</h1>

                    <p>cover: {{ $post->cover }}</p>

                    <p>{{ $post->description }}</p>
                    <p>{{ $post->content }}</p>
                    <p>{{ $post->subtitle }}</p>
                    <p>{{ $post->active }}</p>
                    <p>{{ $post->category_id }}</p>

                    @endforeach

                    <hr>

                    {{ $posts }}
                </div>
            </div> --}}
        </div>
      </div>
    </div>
</div>
@endsection
