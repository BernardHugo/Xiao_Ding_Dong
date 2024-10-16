@extends('./layout/admin_navbar')

<link rel="stylesheet" href="{{ asset('css/view_profile_style.css') }}">

@section('content')

@if(session('success'))    
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="title-container">
    <h1 style="color: yellow">食物详情|Your Profile</h1>
</div>


<div class="profile-container"> 
    <div class="profile-info">
        <p>Your username: {{Auth::user()->name}}</p>
    </div>
    <div class="profile-info">
        <p>Your email: {{Auth::user()->email}}</p>
    </div>
    <div class="profile-info">
        <p>Your phone number: {{Auth::user()->phone}}</p>
    </div>
    <div class="profile-info">
        <p>Your address: {{Auth::user()->address}}</p>
    </div>
    <div class="profile-info">
        <p>Your password: {{Auth::user()->password}}</p>
    </div>
    <div class="profile-image">
        <p>Your profile picture: </p>
        <img src = "{{ asset('storage/images/'.Auth::user()->profile_picture) }}">
    </div>
</div>

<div class = "button-container">
    <button class="edit-button"><a href = "{{ route('admin.edit_profile', Auth::user()->id) }}"> Edit Profile </a></button>
</div>

@endsection('content')