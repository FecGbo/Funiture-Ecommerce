@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/customer/cart.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


@section('title', 'Cart')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner-content">
            <h1>Contact</h1>
            <div class="title">
                <a href="">Home</a>
                <span>></span>
                <span>Cart</span>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="content">
        <div class="content-left">

            <div class="cart-container">


                @if (count($cart) > 0)
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <td>
                                        <div class="cart-image">
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                                width="100%">

                                        </div>

                                    </td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>MMK {{ number_format($item['price']) }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>MMK {{ number_format($item['price'] * $item['quantity']) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                                            <button type="submit" class="remove-cart"
                                                style="background:none; border:none; color:#d9534f; font-size:18px; cursor:pointer;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @php
                        $Total_price = 0;
                        foreach ($cart as $item) {
                            $Total_price += $item['price'] * $item['quantity'];
                        }
                    @endphp

                    <!-- <div class="cart-total">
                                                                                                                                                                                                                <h3>Total Price: MMK {{ number_format($Total_price) }}</h3>
                                                                                                                                                                                                            </div> -->
                @else
                    <p>Your cart is empty.</p>
                @endif
            </div>
        </div>

        <div class="content-right">
            <div class="checkout">
                <h2>Carts Total</h2>
                @if (count($cart) > 0)
                    <div class="cart-subtotal">
                        @foreach ($cart as $item)
                            <p>Subtotal: MMK {{ number_format($item['price'] * $item['quantity']) }}</p>
                        @endforeach
                    </div>
                    <span>Total: MMK {{ number_format($Total_price) }}</span>
                @endif


                <x-button type="submit" :variant="'success'" class="checkoutbtn">Checkout</x-button>
            </div>

        </div>
    </div>

    @stack('scripts')

@endsection