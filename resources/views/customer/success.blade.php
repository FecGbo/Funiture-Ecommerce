@extends('layouts.customer')
@section('title', 'Payment Successful')
<link rel="stylesheet" href="{{ asset('css/customer/success.css') }}">

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

    <div class="mid-section">
        <div class="mid-content">
            <div class="mid-image">
                <img src="{{ asset('images/success.png') }}" alt="Mr. David" class="mid-photo">
            </div>
            <div class="mid-info">
                <h2>Your Payment was successfully</h2>


                <p class="description">
                    Thank You for your purchase! We will be in contact with more details shortly.
                </p>


            </div>
            <div class="okbtn">
                <x-button type="button" onclick="window.location.href='{{route('customer.latestFuniture')}}'"
                    class="ok">OK</x-button>

            </div>


        </div>
    </div>

@endsection