@extends('layouts.admin')

@section('content')
<div class="row text-center">
    <div class="col-12 p-4">
        <h2>Criar Usuário</h2>
    </div>
</div>

<div class="row">
    <div class="col-10 mx-auto rounded bg-white p-4">
        <form action="{{ route('admin.user.create') }}" method="post" enctype="multipart/form-data" class="col-12">
            @csrf
            @method('PUT')

            @include('Admin.user._form')

            <div class="col-12 m-2">
                <button type="submit" class="btn btn-success btn-block">Criar</button>
            </div>
        </form>
    </div>
</div>
@endsection
