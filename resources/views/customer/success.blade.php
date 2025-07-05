@extends('layouts.customer')
@section('title', 'Payment Successful')

@section('content')
    <div class="banner">
        <div class="banner-content">
            <h1>Payment Successful</h1>
            <div class="title">
                <a href="{{ url('/') }}">Home</a>
                <span>></span>
                <span>Success</span>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="content-left">
            <h2>Thank You!</h2>
            <p>Your payment was successful. Thank you for your purchase!</p>
            <a href="{{ route('customer.product') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
@endsection