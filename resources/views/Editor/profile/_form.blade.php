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
