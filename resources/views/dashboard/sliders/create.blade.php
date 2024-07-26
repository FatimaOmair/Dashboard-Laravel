@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class=" text-2xl font-bold">Create Slider</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.sliders._form',[
                                'button_label'=> 'Create slider'
                               ])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
