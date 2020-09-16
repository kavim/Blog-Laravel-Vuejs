@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> postcategory</h1>
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
                    <b>Categorias</b>
                    <a class="btn btn-success" href="{{ route('postcategory.create') }}">nova</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">nome</th>
                            <th scope="col">action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($postcategories as $pc)
                                <tr>
                                    <td>{{ $pc->name }}</td>
                                    <td><a href="/editor/category/edit/{{ $pc->id }}" >Editar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
