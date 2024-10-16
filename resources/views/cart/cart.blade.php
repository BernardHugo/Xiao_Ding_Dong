@extends('./layout/navbar')

<link rel="stylesheet" href="{{ asset('css/cart_style.css') }}">

@section('content')

<div class="header">
    <h1 style="color: yellow">你的购物车|Your Cart</h1>
</div>

@if($cartFood->isEmpty())

<div class="cart-container">
    <div class="empty-container">
        <h2 style="color: yellow">Your cart is empty...</h1>
        <p style="color: white;">Looks like your cart is on a diet! Don't worry, our delicious dishes are just a few clicks away. Start filling up your cart and let the feast begin!</p>
    </div>
</div>

@else

<div class="cart-container">
    <div class="cart-table">
        <table>
            <thead>
                <tr>
                    <th style="color: yellow">Food</th>
                    <th style="color: yellow">Price</th>
                    <th style="color: yellow">Quantity</th>
                    <th style="color: yellow">Total</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @php($sum = 0)
                @foreach($cartFood as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>${{ $item->price }}</td>
                    <td>
                        <div class="quantity">
                            <form action="{{ route('quantity.minus', $item->cart_id) }}" method="post">
                                @csrf
                                <button type="submit" class="minus-button">-</button>
                            </form>
                            <div class="quantity-box">
                                {{ $item->quantity }}
                            </div>
                            <form action="{{ route('quantity.plus', $item->cart_id) }}" method="post">
                                @csrf
                                <button type="submit" class="plus-button">+</button>
                            </form>
                        </div>
                    </td>

                    <td>${{ $item->price * $item->quantity }}</td>
                    <td>
                        <form action="{{ route('carts.destroy', $item->cart_id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button btn-danger">Remove</button>
                        </form> 
                    </td>
                    @php($sum += ($item->price * $item->quantity))
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="price-container">
        <h2 style="color: white">Total price: ${{ $sum }}</h2>
        <button type="submit" class="button" onclick="window.location='{{ route('checkout') }}'">Proceed to Checkout</button>
    </div>
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