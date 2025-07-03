<!DOCTYPE html>
<html lang="en">
@php
    $cart = session('cart', []);
    $cartCount = 0;
    $subTotal = 0;
    $Total_price = 0;
    foreach ($cart as $item) {
        $cartCount += $item['quantity'];
        $subTotal += $item['price'] * $item['quantity'];

    }
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Furniro')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    @stack('styles')
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <a href="" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" height="40">
                Furniro
            </a>

            <ul class="nav-links" id="navLinks">
                <li><a href="" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('customer.product') }}"
                        class="{{ request()->routeIs('product') ? 'active' : '' }}">Product</a></li>
                <li><a href="{{route('customer.about')}}"
                        class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                </li>
                <li><a href="{{ route('customer.content') }}"
                        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>

            <div class="nav-icons">
                <a href="" title="Profile">
                    <i class="fas fa-user"></i>
                </a>

                <a href="javascript:void(0)" title="Cart" id="cartIcon"
                    style="position:relative; display:inline-block;">
                    <i class="fas fa-shopping-cart" onclick="openmodal()"></i>
                    <span id="cartCount" class="cart-count-badge">{{ $cartCount }}</span>
                </a>
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
    </header>

    <div class="cart-modal" style="display: none;">
        <div class="cart-content">
            <div class="cart-content-header">
                <h2>Shopping Cart</h2> <span style="cursor:pointer;float:right;font-size:24px;"
                    onclick="document.querySelector('.cart-modal').style.display='none'">&times;</span>
            </div>
            <hr style="width:80%; margin: 0 auto;">

            <ul id="cartItems">
                @forelse($cart as $item)

                    <li style="" class="cart_list">
                        <div class="cart-left">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="100%"
                                height="100%" style="border-radius:4px;">
                        </div>
                        <div class="cart-center">
                            <span>{{ $item['name'] }}</span>
                            <div class="card-price">
                                <span>{{ $item['quantity'] }} x</span>
                                <span>MMK {{ number_format($item['price']) }}</span>
                            </div>

                        </div>
                        <div class="cart-right">
                            <span class="remove-cart-items" data-id="{{ $item['id'] }}"
                                style="
                                                                                                    cursor:pointer;">&times;</span>
                        </div>
                    </li>

                @empty
                    <div class="no_cart_list">
                        <img src="{{ asset('images/nocart.png') }}" alt="No items in cart">
                        <h2><strong>Your Cart is Empty</strong></h2>
                    </div>
                @endforelse

            </ul>
            <div class="cart-total">


                @if (count($cart))
                    <span>Subtotal</span>
                    <strong>MMK.{{ number_format($subTotal) }} <span id="cartTotal"></span>
                @else
                        <p style="text-align: center;">Add somethings to make happy.....!</p>

                    @endif
            </div>
            <div class="cart-payment">
                @if (count($cart))
                    <x-button id="checkoutBtn">PROCEED TO BAG</x-button>
                    <x-button id="continueShoppingBtn" onclick="location.href='{{ route('customer.product') }}'">CONTINUE
                        SHOPPING</x-button>
                @else
                    <x-button id="continueShoppingBtn" onclick="location.href='{{ route('customer.product') }}'">CONTINUE
                        SHOPPING</x-button>

                @endif



            </div>


        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Funiro.</h3>
                <address>
                    400 University Drive Suite 200<br>
                    Coral Gables,<br>
                    FL 33134 USA
                </address>
            </div>

            <div class="footer-section">
                <h3>Links</h3>
                <ul class="footer-links">
                    <li><a href="">Home</a></li>
                    <li><a href="">Product</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Customer Care</h3>
                <ul class="footer-links">
                    <li><a href="">Payment Options</a></li>
                    <li><a href="">Returns</a></li>
                    <li><a href="">Privacy Policies</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Payment Information</h3>
                <div class="payment-icons">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-paypal"></i>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>2025 furniture Shop. Design By O-Technique Myanmar</p>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (event) {
            const navLinks = document.getElementById('navLinks');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');

            if (!navLinks.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                navLinks.classList.remove('active');
            }
        });

        function openmodal() {
            document.querySelector('.cart-modal').style.display = 'block';
        }

        $(document).on('click', '.remove-cart-items', function () {
            var itemId = $(this).data('id');
            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: itemId
                },
                success: function (response) {
                    if (response.cart_count !== undefined) {
                        $('#cartCount').text(response.cart_count);

                    }

                    $.get('{{ route("cart.items") }}', function (data) {
                        $('#cartItems').parent().html(data.html);
                    });

                }

            });
        });



    </script>

    @stack('scripts')
</body>

</html>