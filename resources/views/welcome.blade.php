@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/customer/index.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title', 'Home')
@section('content')
    <div class="main-wrapper">
        <div class="banner">
            <div class="banner-content">
                <div class="image-slider" id="slider">
                    <div class="slide active">
                        <img src="{{ asset('images/MakeGroup.png') }}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('images/sofa2.jpg') }}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('images/mini.jpg') }}" alt="">
                    </div>
                </div>
                <div class="slide-nav" id="slideNav">
                    <div class="btn active"></div>
                    <div class="btn"></div>
                    <div class="btn"></div>
                </div>
                <div class="banner-btn">
                    <h1>Discover New Collection</h1>
                    <x-button :type="'button'" variant="primary"
                        onclick="window.location.href='{{ route('customer.product') }}'"
                        style="background:black;color:#ffd700;border-radius: 8px;">Shop Now</x-button>
                </div>

            </div>
        </div>





        <div class="product-flex" style="text-align: center;">

            <h1>Latest Luxury Furniture</h1>

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
                        <button class="addToCart-btn" onclick="addToCart({{ $product->id }})">Add to Cart</button>
                    </div>
                @endforeach
            </div>
            <div id="Content" class="search-data"></div>





        </div>
        <!-- @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif -->
        <div class="mid-section">
            <div class="mid-content">
                <div class="mid-image">
                    <img src="{{ asset('images/BED.jpg') }}" alt="Mr. David" class="mid-photo">
                </div>
                <div class="mid-info">
                    <h2>Luxury Golden Furniture</h2>


                    <p class="description">
                        Our designer already made a lot of beautiful prototype of rooms that inspire you. Our designer
                        already
                        made a lot of beautiful prototype of rooms that inspire you.
                    </p>


                    <x-button class="midbtn" onclick="window.location.href='{{ route('customer.product')}}'"
                        style="border-radius: 8px;">Shop</x-button>
                </div>
            </div>
        </div>



        <div class="product-flex" style="text-align: center;">

            <h1>Best Selling Product</h1>

            <div class="products-container" class="all-data" id="all-data">
                @foreach($bestSelling as $product)
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
                        <button class="addToCart-btn" onclick="addToCart({{ $product->id }})">Add to Cart</button>
                    </div>
                @endforeach
            </div>


            <div id="Content" class="search-data"></div>





        </div>



    </div>


    <script>
        const slides = document.querySelectorAll('.slide');
        const navBtns = document.querySelectorAll('.slide-nav .btn');
        let current = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
                navBtns[i].classList.toggle('active', i === index);
            });
            current = index;
        }

        navBtns.forEach((btn, i) => {
            btn.addEventListener('click', () => showSlide(i));
        });

        setInterval(() => {
            let next = (current + 1) % slides.length;
            showSlide(next);
        }, 4000);

        showSlide(0);






        $(document).on('click', '.addToCart-btn', function (e) {
            e.stopPropagation();

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
    </script>
@endsection