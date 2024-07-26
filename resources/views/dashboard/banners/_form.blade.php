<div class="mb-3">
    <label for="title" class="form-label">Title:</label>
    <input type="text" id="title" name="title"
    @class([
        'form-control',
        'is-invalid' => $errors->has('title'),
    ])
    value="{{ old('title',$banner->title) }}"
    class="form-control" value="{{ $banner->title }}" >

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>

    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Image:</label>
    <input type="file" id="image" name="image"
    @class([
        'form-control',
        'is-invalid' => $errors->has('image'),
    ])
    value="{{ old('title',$banner->image) }}"
    class="form-control">

    @error('image')
    <div class="invalid-feedback">
        {{ $message }}
    </div>

    @enderror

    @if($banner->image)
    <td><img src="{{ asset('storage/' . $banner->image) }}" alt="" height="50px"></td>
@else
    <td>No image available</td>
@endif
</div>
<button type="submit" class="btn btn-primary">{{ $button_label }}</button>
