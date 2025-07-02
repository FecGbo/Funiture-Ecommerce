<!DOCTYPE html>
<html lang="en">
@php
    $cart = session('cart', []);
    $cartCount = 0;
    foreach ($cart as $item) {
        $cartCount += $item['quantity'];
    }
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Furniro')</title>


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

                <a href="javascript:void(0)" title="Cart" id="cartIcon">
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
            <h2>Shopping Cart</h2>

            <ul id="cartItems">
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
            </ul>
            <div class="cart-total">
                <strong>Total:</strong> <span id="cartTotal">0</span>
            </div>
            <button id="checkoutBtn">Checkout</button>
            <span style="cursor:pointer;float:right;font-size:24px;"
                onclick="document.querySelector('.cart-modal').style.display='none'">&times;</span>
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

    </script>

    @stack('scripts')
</body>

</html>