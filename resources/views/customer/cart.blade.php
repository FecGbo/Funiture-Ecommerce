@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/customer/cart.css') }}">
<meta name="csrf-token" content={{ csrf_token() }}>
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
                                    <td><input type="number" name="quantity" id="quantityInput" value="{{ $item['quantity'] }}"
                                            min="1" max="10" oninput="if(this.value > 10) this.value = 10;"
                                            onchange="updateQuantity({{ $item['id'] }}, this.value)">
                                    </td>
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
                <div class="checkout-title">
                    <h1>Carts Total</h1>
                </div>

                @if (count($cart) > 0)
                    <div class="cart-subtotal">
                        @foreach ($cart as $item)
                            <p style="color:white">Subtotal: MMK {{ number_format($item['price'] * $item['quantity']) }}</p>
                        @endforeach
                    </div>
                    <span class="total_price">Total: MMK {{ number_format($Total_price) }}</span>
                @endif

                <div class="checkout-button">
                    <form action="{{ route('customer.addOrders') }}" method="POST">
                        @csrf
                        <x-button type="submit" :variant="'success'" class="checkoutbtn">Check Out</x-button>
                    </form>


                </div>
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

            </div>

        </div>
    </div>





@endsection
@push('scripts')
<script>


    function updateQuantity(productId, quantity) {
        $.ajax({
            type: 'POST',
            url: '{{ route("cart.update") }}',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productId,
                quantity: quantity
            },
            success: function (response) {
                if (response.success && response.html) {

                    $('.content-right').replaceWith(response.html);
                }

                if (response.cart_count !== undefined) {
                    $('#cartCount').text(response.cart_count);
                }
            }
        });
    }

</script>