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
        <div class="formContainer col-md-3 mt-6">
            <h1>Register</h1>
            <form action="{{ route('register.validate') }}" method="post">
                @csrf
				<div class="form-group mt-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="text" name="email" class="form-control" placeholder="Has to end with '@gmail.com'">
                </div>
                <div class="form-group mt-3">
                	<label for="name" class="form-label">Username</label>
                	<input type="text" name="name" class="form-control" placeholder="Minimum 5 characters, Maximum 50 characters">
                </div>
            	<div class="form-group mt-3">
                	<label for="password" class="form-label">Password</label>
                	<input type="password" name="password" class="form-control" placeholder="Minimum 5 characters, Maximum 255 characters">
                </div>
                <div class="form-group mt-3">
                	<label for="confirm_password" class="form-label">Confirm Password</label>
                	<input type="password" name="confirm_password" class="form-control" placeholder="Minimum 5 characters, Maximum 255 characters">
                </div>
                <div class="d-grid mx-auto mt-3">
                	<button type="submit" class="btn btn-dark btn-block">Register</button>
            	</div>
            	<p class="link mt-2">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            </form>
        </div>
    </div>
</body>
</html>