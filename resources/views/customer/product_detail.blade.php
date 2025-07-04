@extends('layouts.customer')
@section('title', 'Product Detail')
<link rel="stylesheet" href="{{ asset('css/customer/product_detail.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('content')
    <div class="product-detail-container">

        <div class="product-info">

            <div class="product-info-left">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>

            </div>

            <div class="product-info-right">
                <h1 class="product-name">{{ $product->name }}</h1>


                <h2 class="product-price">MMK{{ number_format($product->sale_price) }}</h2>
                <p class="product-description">{{ $product->description }}</p>

                <div class="addToCart-container">
                    <input type="number" name="quantity" id="quantityInput" value="1" min="1" max="{{ $product->stock }}">
                    <x-button class="addToCart-btn" onclick="addToCart({{ $product->id }})">Add to Cart</x-button>

                </div>

            </div>


        </div>
    </div>
    <script>

        function addToCart(productId) {
            var quantity = $('#quantityInput').val();
            $.ajax({
                type: 'POST',
                url: '{{ route("cart.add") }}',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                    quantity: quantity
                },
                success: function (response) {

                    if (response.cart_count !== undefined) {
                        $('#cartCount').text(response.cart_count);
                    }
                    $.get('{{ route("cart.items") }}', function (data) {
                        $('.cart-modal').html($(data.html).html());
                    });

                    if (response.cart_items !== undefined) {
                        console.log(response);
                    }
                },

            });
        }
    </script>
@endsection