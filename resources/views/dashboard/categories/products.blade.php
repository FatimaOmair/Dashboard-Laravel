@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Products in {{ $category->name }}</li>
@endsection

@section('content')
    <div class="p-5">
        <h1>Products in {{ $category->name }}</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="" height="50px">
                            @else
                                No image available
                            @endif
                        </td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <form action="{{ route('basket.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">Add to Basket</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No products found in this category</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
