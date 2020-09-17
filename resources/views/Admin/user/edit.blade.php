@extends('layouts.admin')

@section('content')
<div class="row">

    <h2>editar usuario</h2>

    <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data" class="col-12">
        @csrf
        @method('PUT')

        @include('Editor.profile._form')

        <div class="col-12 m-2">
            <button type="submit" class="btn btn-success btn-block">Atualizar</button>
        </div>
    </form>

</div>
@endsection
