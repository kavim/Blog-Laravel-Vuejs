@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mt-4">
        <div class="col-lg-10">
            <h3 class="page-header"> Editar categoria </h3>
        </div>
        <div class="col-lg-2">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block"> <i class="fa fa-arrow-left"></i> Voltar </a>
        </div>
    </div>

    <div class="row">
        <form action="{{ route('postcategory.update', $postcategory->id) }}" method="post" enctype="multipart/form-data" class="col-12">
            @csrf

            @include('Editor.category._form')

            <div class="col-12 m-2">
                <button type="submit" class="btn btn-success btn-block">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
