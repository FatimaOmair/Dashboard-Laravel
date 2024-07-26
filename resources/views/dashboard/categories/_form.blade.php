@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occurred!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="categoryName">Category Name</label>
    <x-form.input name="name" value="{{  $category->name }}" type="text"></x-form.input>
</div>

<div class="form-group">
    <label for="parentCategory">Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $category->description) }}</textarea>
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
    @if($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50px">
    @else
        <p>No image available</p>
    @endif
</div>

<div class="form-group">
    <label for="status">Status</label>
<x-form.radio name="status" :checked="$category->status" :options="['active'=>'Active' ,'inactive'=>'Archived']"/>

</div>

<button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
<a href="{{ route('categories.index') }}" class="btn btn-secondary ml-2">Cancel</a>
