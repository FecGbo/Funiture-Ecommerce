@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/customer/aboutus.css') }}">

@section('title', 'About Us')
@section('content')

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>About Us</h1>
            <div class="breadcrumb">Home > About Us</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content-about">
        <!-- Location Section -->
        <div class="location-section">
            <div class="location-info">
                <h2>Furniture Shop Location</h2>
                <div class="location-details">
                    <h3>Yangon Myanmar</h3>
                    <div class="year">Since - 1998</div>
                    <p class="description">
                        Our designer already made a lot of beautiful prototype of rooms that inspire you. Our designer
                        already made a lot of beautiful prototype of rooms that inspire you. Our designer already made a lot
                        of beautiful prototype of rooms that inspire you. Our designer already made a lot of beautiful
                        prototype of rooms that inspire you.
                    </p>
                </div>
            </div>
            <div class="map-container">
                <div class="map-placeholder">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7638.624442053211!2d96.17465423757095!3d16.810860114022045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ecc8f3749e61%3A0x9e8be4b57c0f92d1!2sTamwe%20Township%2C%20Yangon%2C%20Myanmar%20(Burma)!5e0!3m2!1sen!2sus!4v1751280615958!5m2!1sen!2sus"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Founder Section -->
    <div class="founder-section">
        <div class="founder-content">
            <div class="founder-image">
                <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="Mr. David"
                    class="founder-photo">
            </div>
            <div class="founder-info">
                <h2>Luxury Furniture Founder</h2>
                <h3>Mr. David</h3>
                <div class="year">Since - 1998</div>
                <p class="description">
                    Our designer already made a lot of beautiful prototype of rooms that inspire you. Our designer already
                    made a lot of beautiful prototype of rooms that inspire you. Our designer already made a lot of
                    beautiful prototype of rooms that inspire you. Our designer already made a lot of beautiful prototype of
                    rooms that inspire you. 
                </p>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h4>High Quality</h4>
                <p>Crafted from top materials</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4>Warranty Protection</h4>
                <p>Over 2 years</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h4>Free Shipping</h4>
                <p>Order over 150 $</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h4>24 / 7 Support</h4>
                <p>Dedicated support</p>
            </div>
        </div>
    </div>

@endsection