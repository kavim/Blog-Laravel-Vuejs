@extends('layouts.app')

@section('content')

<post-manager :pid='{{ $pid }}'></post-manager>

@endsection
