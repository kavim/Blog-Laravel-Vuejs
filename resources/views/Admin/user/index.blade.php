@extends('layouts.admin')

@section('content')

<div class="row p-4">
    <div class="col-10 mx-auto d-flex justify-content-between">
        <h1>Lista de Usuarios</h1>
        <a class="btn btn-success btn-lg" href="{{ route('admin.user.create') }}">Criar</a>
    </div>
</div>

<div class="row">

    <div class="col-10 mx-auto rounded bg-white p-4">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Nome</th>
                <th scope="col">Tipo</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->user_type_id == 1)
                                Comum
                            @elseif($user->user_type_id === 2)
                                Editor
                            @else
                                Admin
                            @endif
                        </td>
                        <td>
                            @if($user->block == 0)
                                Ativo
                            @else
                                Bloqueado
                            @endif
                        </td>
                        <td>
                            @if ($user->id != 3)
                                <a class="btn btn-link" href="{{ route('admin.user.edit', $user->id) }}">Editar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
