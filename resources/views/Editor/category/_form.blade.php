<label for="name" class="m-2"> Nome: </label>

<input type="text" id="name" name="name" class="form-control col-6" required @if($postCategory) value="{{ $postCategory->name }}" @else placeholder="cat: " @endif>

<div class="m-2">
    <label class="form-check-label " for="is_mobile"> block </label>
    <input class="form-check-input ml-2" type="checkbox" value="1" id="block" name="block" @if($postCategory && $postCategory->block) checked @endif>
</div>
