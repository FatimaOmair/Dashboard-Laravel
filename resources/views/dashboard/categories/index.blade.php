@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="p-5">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary mr-4">Add Category</a>
        <a href="{{ route('categories.trash') }}" class="btn btn-sm btn-outline-primary">Trash</a>

        <!-- Search Form -->
        <form action="{{ route('categories.index') }}" method="GET" class="my-3">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control mb-2" placeholder="Search categories"
                        value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </div>
            </div>
        </form>

        <x-alert type="success" />

        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Products number</th>
                    <th>Created At</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        @if ($category->image)
                            <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50px"></td>
                        @else
                            <td>No image available</td>
                        @endif
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('categories.products', $category->id) }}">{{ $category->name }}</a></td>

                        @if ($category->parent)
                            <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->parent->name }}</a></td>
                        @else
                            <td>None</td>
                        @endif

                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No categories defined</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
