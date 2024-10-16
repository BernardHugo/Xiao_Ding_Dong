<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/navbar_style.css') }}">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: black; width: 100%;">
        <a class="navbar-brand"><img src="{{ asset('images/knife-fork.jpg') }}" width="35" height="40" style="margin-right: 10px; margin-left: 25px;"><b><span style="color: yellow;">XIAO DiNG DoNG</span></b></a>
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">    
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item" style="height: 45px">
                            <a class="nav-link" href="{{ route('home') }}"><b><span style="color: white;">Home</span></b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><b><span style="padding-left: 950px; color: yellow;">Login</span></b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><b><span style="color: yellow;">Register</span></b></a>
                        </li>

                    @else
                        <li class="nav-item" style="margin-top: 10px; height: 40px">
                            <a class="nav-link" href="{{ route('home') }}"><b><span style="color: white;">Home</span></b></a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px; height: 40px">
                            <a class="nav-link" href="{{ route('search_food') }}"><b><span style="color: white; padding-top: 20px;">Search Food</span></b></a>
                        </li>
                        <li class="nav-item" style="margin-right: 690px; margin-top: 10px; height: 40px">
                            <a class="nav-link" href="{{ route('cart') }}"><b><span style="color: white; padding-top: 20px;">Cart</span></b></a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown-box">
                                <button class="dropdown-button"><p><b><span style="color: yellow; padding-top: 10px; margin-right: 10px;">
                                Welcome, {{Auth::user()->name}}</span></b><img src="{{ asset('images/user.jpg') }}" style="width:40px; height: 40px"></p></button>
                                <div class="dropdown-list">
                                    <a href="{{ route('view_profile') }}">Profile</a>
                                    <a href="{{ route('transaction_history') }}">Transaction History</a>
                                    <a href="{{ route('signout') }}">Sign Out</a>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('banner')
    @yield('content')
    @yield('footer')
</body>
</html>