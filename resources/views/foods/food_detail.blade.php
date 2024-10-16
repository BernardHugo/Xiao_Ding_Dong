@extends('./layout/navbar')

<link rel="stylesheet" href="{{ asset('css/detail_style.css') }}">

@section('content')

@if(session('success'))    
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="title">
    <div class="title-container">
        <h1 style="color: yellow">食物详情|Food Detail</h1>
    </div>
</div>

@guest
<div class="food-detail-container"> 
    @foreach($food as $foods)
        <div class="image-container">
            <img src = "{{ asset('storage/images/'.$foods->image) }}">
        </div>
        <div class="text-container">
            <h2>{{ $name }}</h2>
            <br>
            <h2>Food Type:</h2>
            <p>{{ $foods->type }}</p>
            <h2>Food Price:</h2>
            <p>${{ $foods->price }}</p>
            <h2>Brief Description:</h2>
            <p>{{ $foods->brief_description }}</p>
            <h2 style="color: yellow;">About This Food:</h2>
            <p>{{ $foods->about }}</p>
        </div>
    @endforeach
</div>

@else
<div class="food-detail-container"> 
    @foreach($food as $foods)
        <div class="image-container">
            <img src = "{{ asset('storage/images/'.$foods->image) }}">
        </div>
        <div class="text-container">
            <h2>{{ $name }}</h2>
            <br>
            <h2>Food Type:</h2>
            <p>{{ $foods->type }}</p>
            <h2>Food Price:</h2>
            <p>${{ $foods->price }}</p>
            <h2>Brief Description:</h2>
            <p>{{ $foods->brief_description }}</p>
            <h2>About This Food:</h2>
            <p>{{ $foods->about }}</p>
            <form action="{{ route('add_to_cart') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="food_id" value="{{ $foods->id }}">
                <input type="hidden" name="user_id" value="{{ $user }}">
                <input type="submit" class="button" value="Add to Cart">
            </form>
        </div>
    @endforeach
</div>

@endguest

@endsection('content')