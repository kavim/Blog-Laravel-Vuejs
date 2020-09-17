@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-user"></i> Perfil</h1>
    </div>
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
                    <i class="fa fa-check" aria-hidden="true"></i> <b> {{ session('erromsg') }} </b>
                </div>
            @endif

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
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="col-12">
                    @csrf
                    @method('PUT')

                    @include('Editor.profile._form')

                    <div class="col-12 m-2">
                        <button type="submit" class="btn btn-success btn-block">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
