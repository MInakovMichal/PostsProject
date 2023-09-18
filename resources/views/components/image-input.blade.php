<label for="{{ $id }}" class="file-label">
    <div id="image_div">
        <img id="image-preview-{{ $id }}" src="#" alt="Image Preview" style="display: none;">
    </div>
</label>
<input
    type="file"
    name="{{ $name }}"
    id="{{ $id }}"
    class="form-control image-input @error($name) is-invalid @enderror">
<button type="button" id="clear-{{$name}}" class="btn btn-danger mt-2" style="display: none;">&#10006;</button>


