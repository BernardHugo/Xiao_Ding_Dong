@extends('./layout/navbar')

<link rel="stylesheet" href="{{ asset('css/checkout_style.css') }}">

@section('content')

@if($errors->any())
    <div class="alert alert-danger" style="width: 500px; height: 60px;">
        <ul>
            <li>{{ $errors->first() }}</li>
        </ul>
    </div>
@endif

<div class="title-container">
    <h1 style="color: yellow">查看|Checkout</h1>
</div>

<form action="{{ route('order_checkout') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="checkout-form">
        <div class="billing-container">
            <h2 style="color: white">Billing Information</h2>
            <div class="input-container">
                <div class="input-form">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Min 5 characters">
                </div>

                <div class="input-form">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="Has to be 12 numbers">
                </div>
            </div>

            <div class="input-container">
                <div class="input-form">
                    <label for="country">Country</label>
                    <input type="text" name="country" placeholder="Enter your country">
                </div>

                <div class="input-form">
                    <label for="city">City</label> <br>
                    <input type="text" name="city" placeholder="Min 5 characters">
                </div>
            </div>

            <div class="input-container">
                <div class="input-form">
                    <label for="card_name">Card Name</label>
                    <input type="text" name="card_name" placeholder="Min 3 characters">
                </div>

                <div class="input-form">
                    <label for="card_number">Card Number</label>
                    <input type="text" name="card_number" placeholder="Must be numerical and have 16 numbers">
                </div>
            </div>
        </div>

        <div class="additional-container">
            <h2 style="color: white">Additional Information</h2>
            <div class="input-form">
                <label for="address">Address</label>
                <textarea name="address" placeholder="Min 5 characters" style="width: 100%"></textarea>
            </div>

            <div class="input-form">
                <label for="zip">Zip/Postal Code</label>
                <textarea name="zip" placeholder="Fill with number only" style="width: 100%"></textarea>
            </div>
        </div>
    </div>
    <div class="button-container">
        <button type="submit" class="cancel-button btn-block">Cancel</button>
        <button type="submit" class="order-button btn-success">Place Order</button>
    </div>
</form>

@endsection('content')