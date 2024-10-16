@extends('./layout/navbar')

<link rel="stylesheet" href="{{ asset('css/home_style.css') }}">

@section('content')

<div class="menu-container">
    <h1 style="color: yellow">菜单|Menu</h1>
    <br>
    <button class="btn btn-dark btn-block"> <a class = "text-decoration-none text" href = "{{ route('home', ['type' => 'Main Course']) }}"> 主菜|Main Course </a></button>
    <button class="btn btn-dark btn-block"> <a class = "text-decoration-none text" href = "{{ route('home', ['type' => 'Beverage']) }}"> 饮料|Beverages </a> </button>
    <button class="btn btn-dark btn-block"> <a class = "text-decoration-none text" href = "{{ route('home', ['type' => 'Dessert']) }}"> 甜點|Desserts </a> </button>
    <br> <br>
</div>

<div class="title-container">
    @switch($type)
        @case('Main Course')
            <h1 style="color: yellow">主菜|Main Course</h1>
            @break
        @case('Beverage')
            <h1 style="color: yellow">饮料|Beverages</h1>
            @break
        @case('Dessert')
            <h1 style="color: yellow">甜點|Desserts</h1>
            @break
        @default
            <h1 style="color: yellow">主菜|Main Course</h1>
    @endswitch
</div>

<div class="box-container">
    @foreach($food as $foods)
        <a class = "text-decoration-none" href="{{ route('food_detail', ['name' => $foods->name]) }}">
            <div class="box">  
                <div class="image-box">
                    <img src = "{{ asset('storage/images/'.$foods->image) }}">
                </div>
                <p style="color: yellow; font-size: 25px;"><b>{{ $foods->name }}</b></p>
            </div>
        </a>
    @endforeach
</div>

@endsection('content')