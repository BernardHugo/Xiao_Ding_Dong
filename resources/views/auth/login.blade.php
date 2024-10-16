<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/login_regist_style.css') }}">
</head>
<body>
    @if(session('success'))    
        <div class="alert alert-success"> {{ session('success') }} </div>
    @elseif(session('fail_message'))
        <div class="alert alert-danger"> {{ session('fail_message') }} </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" style="width: 500px; height: 60px;">
            <ul>
                <li>{{ $errors->first() }}</li>
            </ul>
        </div>
    @endif
    <div class="form-body">
        <div class="image">
            <img src="{{ asset('images/Chinese-Dishes.jpg') }}" alt="Image">
        </div>
        <div class="formContainer col-md-3 mt-7">
            <h1>Log in</h1>
            <form action="{{ route('login.validate') }}" method="post">
                @csrf
                <div class="form-group mt-3">
                    <label for="email">Email address</label>
                    <input type="text" name="email" class="form-control" placeholder="Has to end with '@gmail.com'">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimum 5 characters, Maximum 255 characters">
                </div>

                <div class="form-group mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember"> Remember me </label>
                    </div>
                </div>
                <div class="d-grid mx-auto mt-3">
                    <button type="submit" class="btn btn-dark btn-block">Login</button>
                </div>
                <p class="link mt-2">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>