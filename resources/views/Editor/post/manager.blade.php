@extends('layouts.app')

@section('content')

<div class="app-title">
<div>
    <h1><i class="fa fa-dashboard"></i> POST</h1>
</div>
<ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="/editor/post">Lista de posts</a></li>
</ul>
</div>

<post-manager :pid='{{ $pid }}'></post-manager>

@endsection
