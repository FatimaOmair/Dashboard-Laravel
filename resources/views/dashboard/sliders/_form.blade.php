<div class="mb-3">
    <label for="title" class="form-label">Title:</label>
    <input type="text" id="title" name="title"
    @class([
        'form-control',
        'is-invalid' => $errors->has('title'),
    ])
    value="{{ old('title',$slider->title) }}"
    class="form-control" value="{{ $slider->title }}" >

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>

    @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description:</label>
    <textarea id="description" name="description"
    @class([
        'form-control',
        'is-invalid' => $errors->has('title'),
    ])
    value="{{ old('title',$slider->title) }}"
    class="form-control" rows="4">{{ $slider->description }}</textarea>

    @error('description')
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
    value="{{ old('image',$slider->image) }}"
    class="form-control">
    @if($slider->image)
    <td><img src="{{ asset('storage/' . $slider->image) }}" alt="" height="50px"></td>

    @error('image')
    <div class="invalid-feedback">
        {{ $message }}
    </div>

    @enderror
@else
    <td>No image available</td>
@endif
</div>
<button type="submit" class="btn btn-primary">{{ $button_label }}</button>
