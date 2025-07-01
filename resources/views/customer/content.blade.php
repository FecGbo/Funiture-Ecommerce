@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/customer/contact.css') }}">

@section('title', 'Contact')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner-content">
            <h1>Contact</h1>
            <div class="breadcrumb">
                <a href="">Home</a>
                <span>></span>
                <span>Contact</span>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="contact">
        <div class="container">

            <!-- Title -->
            <div class="title">
                <h2>Get In Touch With Us</h2>
                <p>For More Information About Our Product & Services, Please Feel Free To Drop Us<br>
                    An Email. Our Staff Always Be There To Help You Out. Do Not Hesitate!</p>
            </div>

            <div class="row">

                <!-- Info -->
                <div class="info">

                    <!-- Address -->
                    <div class="box">
                        <div class="icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Address</h4>
                            <p>236 5th SE AAAA,<br>
                                Yangon AA10000,<br>
                                Myanmar</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="box">
                        <div class="icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Phone</h4>
                            <p>Mobile: +(95) 911111111<br>
                                Hotline: +(95) 922222222</p>
                        </div>
                    </div>

                    <!-- Time -->
                    <div class="box">
                        <div class="icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M16.2,16.2L11,13V7H12.5V12.2L17,14.9L16.2,16.2Z" />
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Working Time</h4>
                            <p>Monday-Friday: 9:00 - 22:00<br>
                                Saturday-Sunday: 9:00 - 21:00</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="form">
                    <form action="#" method="POST">
                        @csrf

                        <div class="field">
                            <label for="name">Your name</label>
                            <input type="text" id="name" name="name" placeholder="Abc" required>
                        </div>

                        <div class="field">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" placeholder="Abc@def.com" required>
                        </div>

                        <div class="field">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="This is an optional">
                        </div>

                        <div class="field">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Hi! I'd like to ask about"
                                required></textarea>
                        </div>

                        <button type="submit" class="btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection