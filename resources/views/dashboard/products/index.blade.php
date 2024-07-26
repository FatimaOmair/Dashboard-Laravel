@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
<div class="p-5">
    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-4">Add Product</a>

    <!-- Search Form -->
    <form action="{{ route('products.index') }}" method="GET" class="my-3">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" name="search" class="form-control mb-2" placeholder="Search products" value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </div>
        </div>
    </form>

    <x-alert type="success"/>

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    @if($product->image)
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50px"></td>
                    @else
                    <td>No image available</td>
                    @endif
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name}}</td>
                    <td>{{ $product->status }}</td>

                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No products defined</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
