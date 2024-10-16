@extends('./layout/navbar')

<link rel="stylesheet" href="{{ asset('css/profile_style.css') }}">

@section('content')

@if(session('success'))    
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@elseif(session('error_message'))
    <div class="alert alert-danger"> {{ session('error_message') }} </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" style="width: 500px; height: 60px;">
        <ul>
            <li>{{ $errors->first() }}</li>
        </ul>
    </div>
@endif

<div class="title-container">
    <h1 style="color: yellow">编辑个人资料|Edit Profile</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('save_profile', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form">
                    <div class="form-group mt-3">
                        <label for="name">Username</label>
                        <input type="text" name="name" placeholder="Minimum 5 characters" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Must be end with @gmail.com" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" placeholder="Must contain 12 numbers" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" placeholder="Do not have to be filled, Minimum 5 characters" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="profile_picture">New Profile Image</label>
                        <input type="file" name="profile_picture" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" placeholder="Has to be the same with previous password" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" placeholder="Minimum 5 characters" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="confirm_new_password">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" placeholder="Has to be the same with new password" class="form-control">
                    </div>
                </div>
                <div class = "buttons">
                    <button type="submit" class="btn btn-success" style="background-color: black; color: white; border: none">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection