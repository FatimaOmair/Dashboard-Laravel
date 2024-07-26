@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
    <form action="{{ route('profile.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->profile->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->profile->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="birthdate">Birthdate</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $user->profile->birthdate }}">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male" {{ $user->profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->profile->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="street_address">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address" value="{{ $user->profile->street_address }}">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $user->profile->city }}">
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ $user->profile->state }}">
        </div>

        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $user->profile->postal_code }}">
        </div>

        <div class="form-group">
            <label for="country">Country</label>
            <select class="form-control" id="country" name="country" required>
                @foreach($countries as $code => $name)
                    <option value="{{ $code }}" {{ $user->profile->country == $code ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="local">Local</label>
            <select class="form-control" id="local" name="local" required>
                @foreach($locales as $code => $name)
                    <option value="{{ $code }}" {{ $user->profile->local == $code ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
@endsection
