@extends('./layout/navbar')

<link rel="stylesheet" href="{{ asset('css/transaction_style.css') }}">

@section('content')
<div class="header">
    <h1 style="color: yellow">交易纪录|Transaction History</h1>
</div>

@if($cartTrans->isEmpty())
    <div class="empty-container">
        <h2 style="color: yellow">There are no transactions yet...</h1>
        <p style="color: white;">Poof!Transaction history gone. Time to make delicious memories all over again. Let's fill this blank page with savory stories and culinary adventures. Bon apetit!</p>
    </div>
@else
    <table>
        <thead>
            <tr>
                <th style="color: yellow">Transaction ID</th>
                <th style="color: yellow">Purchase Date</th>
                <th style="color: yellow">Quantity</th>
                <th style="color: yellow">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartTrans as $transaction)
            @php($date = new DateTime($transaction->updated_at))
            <tr>
                <td>{{'TR'.str_pad($transaction->cart_id, 3, '0', STR_PAD_LEFT)}}</td>
                <td>{{ $date->format('Y-m-d') }}</td>
                <td>{{ $transaction->name }} [x{{ $transaction->quantity }}]</td>
                <td>${{ $transaction->price * $transaction->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
    
@endsection('content')

@section('footer')

<div class="footer-container">
    <div class="account-container">
        <img src="{{ asset('images/twitter.png') }}" width="35" height="40" style="margin: 0 5px;">
        <img src="{{ asset('images/facebook.png') }}" width="35" height="40" style="margin: 0 5px;">
        <img src="{{ asset('images/instagram.png') }}" width="35" height="40" style="margin: 0 5px;">
    </div>
    <p style="text-white">@ 2023 XIAO DiNG DoNG. All rights reserved.</p>
</div>

@endsection('footer')