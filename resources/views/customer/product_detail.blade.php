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

                <div class="stock">
                    <p class="stock-text" style="color:red;">Available: {{ $product->stock }}</p>
                </div>

                <div class="addToCart-container">
                    <input type="number" name="quantity" id="quantityInput" value="1" min="1" max="{{ $product->stock }}"
                        oninput="if(this.value>10) this.value = 10;">
                    <x-button class="addToCart-btn" onclick="addToCart({{ $product->id }})">Add to Cart</x-button>

                </div>

            </div>
            <x-add-success modalId="addCartSuccessModal" message="Product added to cart successfully!"
                confirmId="closeAddCartSuccessBtn"></x-add-success>

            <x-add-success modalId="insufficientStockModal" message="Insufficient stock available!"
                confirmId="insufficientStockBtn" image="report.png"></x-add-success>

            <!-- 
                        @if (session('insufficient-stock'))
                            <div class="alert alert-danger">
                                {{ session('insufficient-stock') }}
                            </div>

                        @endif -->


        </div>
    </div>
    <script>


        document.getElementById('closeAddCartSuccessBtn').onclick = function () {
            document.getElementById('addCartSuccessModal').style.display = 'none';
        };

        document.getElementById('insufficientStockBtn').onclick = function () {
            document.getElementById('insufficientStockModal').style.display = 'none';
        };

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

                    document.getElementById('insufficientStockModal').style.display = 'none';

                    if (response.insufficient_stock) {
                        document.getElementById('insufficientStockModal').style.display = 'block';
                        document.querySelector('#insufficientStockModal .add-success-message').textContent = response.insufficient_stock;
                        // console.log(response);
                        // alert(response.insufficient_stock);
                        return;
                    }


                    if (response.cart_count !== undefined) {

                        $('#cartCount').text(response.cart_count);
                        if (response.cart_count > 0) {
                            $('#cartCount').show();
                        } else {
                            $('#cartCount').hide();
                        }
                    }
                    $.get('{{ route("cart.items") }}', function (data) {
                        $('.cart-modal').html($(data.html).html());
                    });

                    if (response.cart_items !== undefined) {
                        console.log(response);
                    }
                    // alert(response.message || 'Product added to cart successfully.');
                    document.getElementById('addCartSuccessModal').style.display = 'block';
                },

            });
        }
    </script>
@endsection