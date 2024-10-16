@extends('./layout/admin_navbar')

<link rel="stylesheet" href="{{ asset('css/add_update_style.css') }}">

@section('content')

@if(session('success'))    
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" style="width: 600px; height: 60px;">
        <ul>
            <li>{{ $errors->first() }}</li>
        </ul>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="header">
                <h1>添加新食物|Add New Food</h1>
            </div>
            <form action="{{ route('foods.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form">
                    <div class="form-group mt-3">
                        <label for="name">Food Name</label>
                        <input type="text" name="name" placeholder="Minimum 5 characters" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="brief_description">Food Brief Description</label>
                        <textarea name="brief_description" placeholder="Maximum 100 characters" style="width: 100%" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="about">Food Full Description</label>
                        <textarea name="about" placeholder="Maximum 255 characters" style="width: 100%" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="type">Food Category</label>
                        <input type="text" name="type" class="form-control" placeholder="Must be Main Course, Beverage, or Dessert">
                    </div>
                    <div class="form-group mt-3">
                        <label for="price">Food Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Must be more than 0">
                    </div>
                    <div class="form-group mt-3">
                        <label for="image">Food Picture</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" class="btn btn-block" style="background-color: black; color: white">Cancel</button>
                    <button type="submit" class="btn btn-success" style="background-color: black; color: white; border: none">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection