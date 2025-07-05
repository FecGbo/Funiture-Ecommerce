@extends('layouts.customer')
@section('title', 'Checkout')
<link rel="stylesheet" href="{{ asset('css/customer/checkout.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner-content">
            <h1>Contact</h1>
            <div class="title">
                <a href="">Home</a>
                <span>></span>
                <span>Checkout</span>
            </div>
        </div>
    </div>

    <h2>Pay with Card</h2>
    <form id="payment-form" action="{{ route('cart.process-payment') }}" method="POST">
        @csrf
        <div id="card-element"></div>
        <button id="payBtn">Pay Now</button>
        <div id="card-errors" role="alert"></div>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const { token, error } = await stripe.createToken(card);
            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
@endsection