@extends('layouts.admin')

@section('content')

<div class="row p-4">
    <div class="col-10 mx-auto d-flex justify-content-between">
        <h1>Lista de categorias</h1>
        <a class="btn btn-success btn-lg" href="{{ route('admin.categories.create') }}">Criar</a>
    </div>
</div>

<div class="row">
    <div class="col-10 mx-auto rounded bg-white p-4">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($postcategories as $cat)
                    <tr>
                        <td>{{ $cat->name }}</td>
                        <td>
                            @if($cat->block == 0)
                                Ativo
                            @else
                                Bloqueado
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-link" href="{{ route('admin.categories.edit', $cat->id) }}">Editar</a>
                            <br>
                            {{-- <a class="btn btn-link" href="{{ route('admin.categories.delete', $cat->id) }}">Deletar</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
