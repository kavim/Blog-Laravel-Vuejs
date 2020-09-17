@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Perfil</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body text-center">

            @if (session('msg'))
                <div class="alert alert-success">
                    <i class="fa fa-check" aria-hidden="true"></i> <b> {{ session('msg') }} </b>
                </div>
            @endif

            {{ $user->name }}, {{ $user->lastname }}

            <br>

            <a href="{{ route('profile.edit') }}">Editar perfil</a>
        </div>
      </div>
    </div>
</div>
@endsection
