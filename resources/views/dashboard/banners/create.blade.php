@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class=" text-2xl font-bold">Create Banner</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('dashboard.banners._form',[
                            'button_label'=> 'Create banner'
                           ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
