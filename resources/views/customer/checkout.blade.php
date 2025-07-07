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

    <div class="payment">

        <div class="payment-left">
            <div class="card-info">
                <div class="email">
                    <label for="email">Email:</label>
                    <!-- <input type="text" id="email" name="email" value="{{ auth()->user()->email }}" readonly> -->
                    <x-input type="text" id="email" name="email" :value="auth()->user()->email" readonly></x-input>
                </div>


            </div>



            <form id="payment-form" action="{{ route('cart.process-payment') }}" method="POST">
                @csrf
                <span>Card information</span>
                <div class="card_fill">
                    <div id="card-element"> </div>
                    <div class="card-cv">
                        <div id="card-exp"></div>
                        <div id="card-cvc"></div>
                    </div>



                </div>




                <div class="card-holder">
                    <label for="card-holder-name">Card Holder Name:</label>

                    <x-input class="card-holder-input" type="text" id="card-holder-name" name="card_holder_name"
                        placeholder="Enter card holder name" required>
                    </x-input>
                </div>

                <x-button id="payBtn" type="submit">Pay Now</x-button>
                <div id="card-errors" role="alert"></div>
            </form>
        </div>


        <div class="payment-right">
            <div class="payment-image">
                <img src="{{ asset('images/payment.png') }}" alt="Logo">
            </div>
        </div>
    </div>




    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('cardNumber');
        const cardExp = elements.create('cardExpiry');
        const cardCvc = elements.create('cardCvc');
        card.mount('#card-element');
        cardExp.mount('#card-exp');
        cardCvc.mount('#card-cvc');

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