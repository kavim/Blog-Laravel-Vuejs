@if ($post)

{{-- <div id="fundinho" class="fundinho" style='{{ $opa }}'>

    <div class="text-center">
        <label for="file-upload2" class="de-editar" >
            <i class="fa fa-cloud-upload"></i> Alterar capa
        </label>
        <input id="file-upload2" type="file" name="cover" accept="image/png, image/jpeg, image/jpg"/>

        <input id="toremove" type="hidden" name="toremove" value="0"/>

        @if ($post->cover != null)
            <button class="de-remover" type="button" id="remover"><i class="fa fa-trash" aria-hidden="true"></i> Remover</button>
        @endif

        <button id="tosave" type="submit" class="de-salvar" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
    </div>

</div> --}}

@endif

<div id="fundinho" class="fundinho" style='{{ $coverSrc }}'>

    <div class="text-center">
        <label for="file-upload2" class="de-editar" >
            <i class="fa fa-cloud-upload"></i> Alterar capa
        </label>
        <input id="file-upload2" type="file" name="cover" accept="image/png, image/jpeg, image/jpg"/>

        <input id="toremove" type="hidden" name="toremove" value="0"/>

        <button id="tosave" type="submit" class="de-salvar" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
    </div>

</div>

{{-- <input id="file-upload2" type="file" name="cover" accept="image/png, image/jpeg, image/jpg"/> --}}

<br>

<label for="title" class="m-2"> titulo: </label>
<input type="text" id="title" name="title" class="form-control col-6" required @if($post) value="{{ $post->title }}" @else placeholder="title: " @endif>

<label for="subtitle" class="m-2"> subtitle: </label>
<input type="text" id="subtitle" name="subtitle" class="form-control col-6" required @if($post) value="{{ $post->subtitle }}" @else placeholder="subtitle: " @endif>

<label for="description" class="m-2"> description: </label>
<input type="text" id="description" name="description" class="form-control col-6" required @if($post) value="{{ $post->description }}" @else placeholder="description: " @endif>


{{-- content --}}
<textarea name="content" id="contenteditor">OPA um content aqui</textarea>


<label for="categories" class="m-2"> cat: </label>
<select name="postcategory" class="form-control col-6" id="categories" required>
    @foreach ($postCategories as $pc)
        <option value="{{$pc->id}}" @if($post && $pc->id == $post->category_id) selected @endif > {{ $pc->name }} </option>
    @endforeach
</select>

{{-- <label for="image" class="m-2"> Imagem: </label>

<div class="form-group">
    <div class="row no-gutters">
        <div class="col-12">
            @if($banner && $banner->image->id != 1)
                <img id="blah" src="/storage/{{ $banner->image->src }}" class="img-fluid">
            @endif
            <img id="blah" src="" class="img-fluid">
        </div>
        <div class="col-12">
            <label for="file-upload" class="btn btn-success">
                <i class="fa fa-cloud-upload"></i> Enviar
            </label>
            <input id="file-upload" type="file" name="image"/>
        </div>
    </div>
</div> --}}

<div class="m-2">
    <label class="form-check-label " for="is_mobile"> Publicar? </label>
    <input class="form-check-input ml-2" type="checkbox" value="1" id="active" name="active" @if($post && $post->active) checked @endif>
</div>

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#contenteditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#fundinho').css('background-image', 'url(' + e.target.result + ')');
            }

            console.log("opaopaopa");

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('input[name=cover]').change(function() {

        console.log("console.log($('#fundinho').css('background-image'));")
        console.log($('#fundinho').css('background-image'));

        console.log("---------------------------------------------------------------------");

        readURL(this);

        console.log($('#fundinho').css('background-image'));

        console.log("to mudando aqui");

    });

    $( "#remover" ).click(function() {

        if(confirm("Remover?")){
            $('#toremove').val(1);

            $( "#formtarget" ).submit();
        }
    });
</script>
@endsection
