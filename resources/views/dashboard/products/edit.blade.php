@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Edit Product</li>
@endsection

@section('content')
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name"
            @class([
                'form-control',
                'is-invalid' => $errors->has('name'),
            ])
            value="{{ old('name', $product->name) }}">

            @error('name')
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
                'is-invalid' => $errors->has('description'),
            ])>{{ old('description', $product->description) }}</textarea>

            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="text" id="price" name="price"
            @class([
                'form-control',
                'is-invalid' => $errors->has('price'),
            ])
            value="{{ old('price', $product->price) }}">

            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="compare_price" class="form-label">Compare Price:</label>
            <input type="text" id="compare_price" name="compare_price"
            @class([
                'form-control',
                'is-invalid' => $errors->has('compare_price'),
            ])
            value="{{ old('compare_price', $product->compare_price) }}">

            @error('compare_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" id="stock" name="stock"
            @class([
                'form-control',
                'is-invalid' => $errors->has('stock'),
            ])
            value="{{ old('stock', $product->stock) }}">

            @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select id="category_id" name="category_id"
            @class([
                'form-control',
                'is-invalid' => $errors->has('category_id'),
            ])>
                @foreach(App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
        <label for="store_id">Store:</label>
        <select id="store_id" name="store_id" required>
            @foreach($stores as $store)
                <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
        </select>
    </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" id="image" name="image"
            @class([
                'form-control',
                'is-invalid' => $errors->has('image'),
            ])>

            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="" height="50px">
            @else
                <p>No image available</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="ratings" class="form-label">Ratings:</label>
            <input type="number" step="0.1" id="ratings" name="ratings"
            @class([
                'form-control',
                'is-invalid' => $errors->has('ratings'),
            ])
            value="{{ old('ratings', $product->ratings) }}">

            @error('ratings')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="options" class="form-label">Options:</label>
            <textarea id="options" name="options"
            @class([
                'form-control',
                'is-invalid' => $errors->has('options'),
            ])>{{ old('options', json_encode($product->options)) }}</textarea>

            @error('options')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="featured" class="form-label">Featured:</label>
            <select id="featured" name="featured"
            @class([
                'form-control',
                'is-invalid' => $errors->has('featured'),
            ])>
                <option value="0" {{ old('featured', $product->featured) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('featured', $product->featured) == 1 ? 'selected' : '' }}>Yes</option>
            </select>

            @error('featured')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status"
            @class([
                'form-control',
                'is-invalid' => $errors->has('status'),
            ])>
                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="archived" {{ old('status', $product->status) == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>

            @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
@endsection
