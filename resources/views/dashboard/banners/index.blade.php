@extends('layouts.dashboard')

@section('content')
<div class="container mt-4 w-75 m-auto">
    <div class="row">

        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold mb-4">Banners</h1>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $index => $banner)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $banner->title }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-20 h-20 object-cover" height="80px">
                            </td>
                            <td>
                                <a href="{{ route('dashboard.banners.edit', $banner->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('dashboard.banners.destroy', $banner->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this banner?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="col-lg-3 col-md-6 mx-auto text-center">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h4 class="">Create banner</h4>
                <p class="card-text">Add a new banner.</p>
                <a href="{{ route('dashboard.banners.create') }}" class="btn btn-light">Create</a>
            </div>
        </div>
    </div>

</div>
@endsection


