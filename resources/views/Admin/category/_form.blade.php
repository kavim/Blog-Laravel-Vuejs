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

<label for="name" class="m-2"> Nome: </label>
@if($postcategory)
    <input type="text" id="name" name="name" class="form-control" value="{{ $postcategory->name }}" title="Nome do usuário" size="100" minlength="1" maxlength="100" required>
@else
    <input type="text" id="name" name="name" placeholder="Nome: " class="form-control" size="100" minlength="1" maxlength="100" required>
@endif

<div class="m-2">
    <small>marque aqui para bloquear categorias e seuas posts</small> <br>
    <label class="form-check-label " for="is_block"> Bloaquer </label>
    <input id="is_block" class="form-check-input ml-2" type="checkbox" value="1" id="block" name="block" @if($postcategory && $postcategory->block == 1) checked @endif>
</div>
