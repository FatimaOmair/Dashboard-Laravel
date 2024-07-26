@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class=" text-2xl font-bold">Edit Banner</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.banners._form',[
                            'button_label'=> 'Update banner'
                           ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
