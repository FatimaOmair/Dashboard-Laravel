@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Trashed Categories</li>
@endsection

@section('content')

<div class="p-5">
    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>

    <!-- Search Form -->
    <form action="{{ route('categories.index') }}" method="GET" class="my-3">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" name="search" class="form-control mb-2" placeholder="Search categories" value="{{ request('search') }}">
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
                <th>Deleted At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    @if($category->image)
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50px"></td>
                    @else
                    <td>No image available</td>
                    @endif

                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No categories defined</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
