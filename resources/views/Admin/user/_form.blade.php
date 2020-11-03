@if(Session::has('msg'))
	<div class="col-12 col-md-6 py-3 mt-3 mx-auto text-center alert alert-success">
		<p>{{ Session::get('msg') }}</p>
	</div>
@endif

@if(Session::has('erro-msg'))
	<div class="col-12 col-md-6 py-3 mt-3 mx-auto text-center alert alert-success">
		<p>{{ Session::get('erro-msg') }}</p>
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

<label for="name" class="m-2"> Email: </label>
@if($user)
    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" title="Nome do usuário" size="100" minlength="1" maxlength="100" required>
@else
    <input type="email" id="email" name="email" placeholder="Email: " class="form-control" size="100" minlength="1" maxlength="100" required>
@endif

<label for="name" class="m-2"> Nome: </label>
@if($user)
    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" title="Nome do usuário" size="100" minlength="1" maxlength="100" required>
@else
    <input type="text" id="name" name="name" placeholder="Nome: " class="form-control" size="100" minlength="1" maxlength="100" required>
@endif

<label for="name" class="m-2"> Sobrenome: </label>
@if($user)
    <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $user->lastname }}" title="SobreNome" size="100" minlength="1" maxlength="100" required>
@else
    <input type="text" id="lastname" name="lastname" placeholder="SobreNome: " class="form-control" size="100" minlength="1" maxlength="100" required>
@endif

<label for="name" class="m-2"> Telefone: </label>
@if($user)
    <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" title="Nome do usuário" size="100" minlength="1" maxlength="100" required>
@else
    <input type="text" id="phone" name="phone" class="form-control" size="100" minlength="1" maxlength="100" placeholder="00000000000" required>
@endif

<div class="m-2">
    <small>marque aqui para bloquear usuário</small> <br>
    <label class="form-check-label " for="is_block"> Bloaquer </label>
    <input id="is_block" class="form-check-input ml-2" type="checkbox" value="1" id="block" name="block" @if($user && $user->block == 1) checked @endif>
</div>

<label for="user_type_id" class="m-2"> Tipo de user: </label>
<select name="user_type_id" class="form-control" id="banner_type_id" required>
    @foreach ($userTypes as $ut)
        <option value="{{$ut->id}}" @if($ut && $user && $ut->id == $user->user_type_id) selected @endif > {{ $ut->name }} </option>
    @endforeach
</select>

@if($user)
    <hr>

    <small>Alterar a senha por aqui para reSetar</small>
    <br>

    <label for="senha" class="m-2">Nova Senha para este usuário: </label>
    <input type="password" id="senha" name="password" class="form-control" value="" title="Senha" size="100" minlength="1" maxlength="100" autocomplete="none">

    <label for="adminpassword" class="m-2"> Senha do Admin: </label>
    <input type="password" id="adminpassword" name="adminpassword" class="form-control" value="" title="Senha" size="100" minlength="1" maxlength="100">
@else

<label for="senha" class="m-2">Nova Senha para este usuário: </label>
<input type="password" id="senha" name="password" class="form-control" value="" title="Senha" size="100" minlength="1" maxlength="100" autocomplete="none">

<label for="senha" class="m-2">Confirmar senha: </label>
<input type="password" id="confsenha" name="confsenhapassword" class="form-control" value="" title="Senha" size="100" minlength="1" maxlength="100" autocomplete="none">

@endif



@section('scripts')
<script>
    $(document).ready(function($){

        $('#phone').mask('(00) 00000-0000');

        $('#phone').keyup('change', function() {
            var phone = $('#phone').cleanVal();
            // $("input[name=phone]").val(phone);
        });
    });
</script>
@endsection
