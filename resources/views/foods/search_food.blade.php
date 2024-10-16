@extends('./layout/navbar')

<link rel="stylesheet" href="{{ asset('css/search_style.css') }}">

@section('content')

<form action="{{ route('search_food') }}">
    <div class="search-container">
        <div class = "header">
            <h1>搜索食品|Search Foods</h1>
        </div>
        <div class="d-flex">
            <input class="form-control me-2" type="search" style="width: 70%" placeholder="Enter food name" aria-label="Search" name="search">
            <button class="search_button btn-outline-success" type="submit">Search</button>
        </div>
    </div>
    <div class="category-box">
        <div class="category">
            <p>Filter Category</p>
            <input type="checkbox" name="main_course" value = "1">
            <label for="main_course" style="color: white;"> Main Course </label>
            <input type="checkbox" name="beverage" value = "1">
            <label for="beverage" style="color: white;"> Beverages </label>
            <input type="checkbox" name="dessert" value = "1">
            <label for="dessert" style="color: white;"> Desserts </label>
        </div>
    </div>
</form>

@if($food->isEmpty())
    <div class="empty-container">
        <p style="color: white;">Food is not available.</p>
    </div>
@else
<div class="content">
    @foreach($food as $foods)
        <a class = "text-decoration-none" href="{{ route('food_detail', ['name' => $foods->name]) }}">
            <div class="food-container">
                <div class="image-container">
                    <img src = "{{ asset('storage/images/'.$foods->image) }}">
                </div>
                <div class="text-container">
                    <h1>{{ $foods->name }}</h1>
                    <br>
                    <h2>Category:</h2>
                    <p>{{ $foods->type }}</p>
                    <h2>Description:</h2>
                    <p>{{ $foods->brief_description }}</p>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endif

@endsection('content')

@section('footer')

<div class="footer-container">
    <div class="account-container">
        <img src="{{ asset('images/twitter.png') }}" width="40" height="40" style="margin: 0 5px;">
        <img src="{{ asset('images/facebook.png') }}" width="40" height="40" style="margin: 0 5px;">
        <img src="{{ asset('images/instagram.png') }}" width="40" height="40" style="margin: 0 5px;">
    </div>
    <p style="color: white">@ 2023 XIAO DiNG DoNG. All rights reserved.</p>
</div>

@endsection('footer')