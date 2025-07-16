@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/customer/product.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Product')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner-content">
            <h1>Product</h1>
            <div class="breadcrumb">
                <a href="">Home</a>
                <span>></span>
                <span>Product</span>
            </div>
        </div>
    </div>


    <div class="contact">
        <div class="container">
            <div class="title">
                <div class="title-left">
                    <img src="{{ asset('images/logo.png') }}" alt="Product Banner">
                    <span>Furniro Products</span>
                </div>

                <div class="title-right">
                    <div class="search-bar">
                        <input type="text" placeholder="Search for products..." id="searchInput" name="searchInput">

                    </div>
                    <div class="sort">
                        <span style="color: #ffd700;">Sort by</span>
                        <select name="sort" id="sort">
                            <option value="id-asc" {{ request('sort', 'id-asc') == 'id-asc' ? 'selected' : '' }}>Default
                            </option>
                            <option value="sale_price-asc" {{ request('sort') == 'sale_price-asc' ? 'selected' : '' }}>
                                Price: Low to High
                            </option>
                            <option value="sale_price-desc" {{ request('sort') == 'sale_price-desc' ? 'selected' : '' }}>
                                Price: High to Low
                            </option>

                        </select>

                    </div>


                </div>


            </div>
            <div class="main-content-product">

                <div class="product-sidebar">
                    <div class="filter-section">
                        <h3>Searching Information</h3>
                    </div>

                    <div class="filter-section">
                        <h3>Price</h3>
                        <div class="price-range">
                            <div class="price-inputs">
                                <div class="price-input">
                                    <label>Min</label>
                                    <input type="number" placeholder="0" min="0" id="minPrice">
                                </div>
                                <div class="price-input">
                                    <label>Max</label>
                                    <input type="number" placeholder="1000000" min="0" id="maxPrice">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Filter</h3>
                        <h3>Furniture</h3>
                        <ul class="filter-options">

                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="chair">
                                    Chair
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="sofa">
                                    Sofa
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="table">
                                    Table
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="lamp">
                                    Lamp
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="product-flex">

                    <div class="products-container" class="all-data" id="all-data">
                        @foreach($products as $product)
                            <div class="product-card">
                                <a href="{{ route('customerProduct.detail', $product->id) }}">
                                    <div class="product-image">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-name">{{ $product->name }}</h3>
                                        <p class="product-description">{{ $product->description }}</p>

                                    </div>
                                    <div class="product-price">MMK {{ number_format($product->sale_price) }}</div>
                                </a>
                                <button class="addToCart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                            </div>
                        @endforeach
                    </div>
                    <div id="Content" class="search-data"></div>





                </div>


            </div>



            <div class="pagination">
                {{ $products->links() }}
            </div>


        </div>
    </div>


    <script>
        $(document).on('click', '.addToCart-btn', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var productId = $(this).data('product-id');
            addToCart(productId);
        });


        function addToCart(productId) {
            $.ajax({
                type: 'POST',
                url: '{{ route("cart.add") }}',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId
                },
                success: function (response) {
                    // alert(response.message);
                    if (response.cart_count !== undefined) {
                        $('#cartCount').text(response.cart_count);
                    }
                    if (response.cart_items !== undefined) {
                        console.log(response.cart_items);
                    }

                    $.get('{{ route("cart.items") }}', function (data) {
                        $('#cartItems').parent().html(data.html);
                    });
                },

            });
        }

        //search
        $(document).ready(function () {
            $('#searchInput, #minPrice, #maxPrice').on('input', function () {
                var $search = $('#searchInput').val();
                var $minPrice = $('#minPrice').val();
                var $maxPrice = $('#maxPrice').val();

                if ($search || $minPrice || $maxPrice) {
                    $('#all-data').hide();
                    $('#Content').show();
                } else {
                    $('#all-data').show();
                    $('#Content').hide();
                }
                $.ajax({
                    type: 'GET',
                    url: '{{ URL::to('customer-search') }}',
                    data: {
                        'customer-search': $search,
                        'min-price': $minPrice,
                        'max-price': $maxPrice
                    },
                    success: function (data) {
                        $('#Content').html(data.html);
                    }
                });
            });
        });


        //sort
        $(document).ready(function () {
            $('#sort').on('change', function () {
                let sortValue = $(this).val();
                let [sortBy, sortDir] = sortValue.split('-');

                $.ajax({
                    type: 'GET',
                    url: '{{ url()->current() }}',
                    data: {
                        sort: sortBy === 'price' ? 'sale_price' : sortBy,
                        dir: sortDir
                    },
                    success: function (data) {
                        if (data.html) {
                            $('#all-data').html(data.html);
                        }
                    }
                });
            });
        })

    </script>
@endsection