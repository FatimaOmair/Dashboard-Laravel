@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Show Product</li>
@endsection

@section('content')

<table class="table">
    <thead>
        <tr>

            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($product->products as $product )


        <td>{{ $product->name }}</td>
        <td>{{ $product->store->name}}</td>
        <td>{{ $product->status }}</td>
        <td>{{ $product->created_at->format('Y-m-d') }}</td>

        @endforelse


        @empty
            <tr>
                <td colspan="5">No products defined</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
