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


<br>

<label for="title" class="m-2"> titulo: </label>
<input type="text" id="title" name="title" class="form-control col-6" required @if($post) value="{{ $post->title }}" @else placeholder="title: " @endif>

<label for="subtitle" class="m-2"> subtitle: </label>
<input type="text" id="subtitle" name="subtitle" class="form-control col-6" required @if($post) value="{{ $post->subtitle }}" @else placeholder="subtitle: " @endif>

<label for="description" class="m-2"> description: </label>
<input type="text" id="description" name="description" class="form-control col-6" required @if($post) value="{{ $post->description }}" @else placeholder="description: " @endif>

<br>
<br>
{{-- content --}}
<label for="w3review">Conteudo:</label>
<textarea rows="10" name="content" id="contenteditor">OPA um content aqui</textarea>

<label for="categories" class="m-2"> cat: </label>
<select name="postcategory" class="form-control col-6" id="categories" required>
    @foreach ($postCategories as $pc)
        <option value="{{$pc->id}}" @if($post && $pc->id == $post->category_id) selected @endif > {{ $pc->name }} </option>
    @endforeach
</select>


<h1>
    {{-- {{ $post->video[0]->src }} --}}
</h1>

<div class="my-2">

    <label for="video" class="m-2"> video: </label>
    <input type="text" id="video" name="videos[]" class="form-control col-6" onchange="loadVideo(this.value)" placeholder="cole o link do video aqui" @if($post && count($post->video)>0) value="{{ $post->video[0]->src }}"@endif>

    <br>

    <div id="myCode"></div>
    <div id="myId"></div>

</div>


<br>
<br>


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
    function getId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);

            if (match && match[2].length == 11) {
                return match[2];
            } else {
                return 'error';
            }
        }

        var myId;
        function loadVideo(that) {
            // var myUrl = $('#link_video').val();

            var myUrl = that;

            if(myUrl === " " || myUrl === ""){
                console.log(myUrl);
            }else{
                myId = getId(myUrl);
                $('#myId').html(myId);
                if(myId != 'error'){
                    $('#myCode').html('<iframe width="560" height="315" src="https://www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
                }
            }

                // console.log(that.value);

        }

        loadVideo($("#video").val());
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
