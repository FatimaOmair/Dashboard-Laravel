@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
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
        <label for="productName">Product Name</label>
        <x-form.input name="name" value="{{  $product->name }}" type="text"></x-form.input>
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

    <div class="form-group">
        <label for="parentProduct">Product Parent</label>
        <select name="parent_id" class="form-control form-select">
            <option value="">Primary product</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $product->parent_id) == $parent->id)>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="" height="50px">
        @else
            <p>No image available</p>
        @endif
    </div>

    <div class="form-group">
        <label for="status">Status</label>
    <x-form.radio name="status" :checked="$product->status" :options="['active'=>'Active' ,'inactive'=>'Archived']"/>

    </div>

    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">Cancel</a>

    </form>
@endsection
