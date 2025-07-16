@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@section('content')

    <div class="banner">
        <div class="banner-content">
            <h1>Contact</h1>
            <div class="title">
                <a href="">Home</a>
                <span>></span>
                <span>Register</span>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="content-left">
            <div class="content-left-img">
                <img src="{{ asset('images/register.png') }}" alt="" width="100%" height="100%">
            </div>
        </div>
        <div class="content-right">
            <form action="{{ route('auth.register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h1>Register</h1>


                @if ($errors->any())
                    <div style="color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="name">
                    <x-input name="name" type="text" required placeholder="Full Name"></x-input>
                </div>
                <div class="dob">
                    <x-input name="dob" type="text" required placeholder="Date of Birth"></x-input>
                </div>
                <div class="email">

                    <x-input name="email" type="email" required placeholder="Email Address"></x-input>

                </div>
                <div class="phone">

                    <x-input name="phone" type="text" required placeholder="Phone Number"></x-input>

                </div>
                <div class="address">
                    <x-input name="address" type="text" required placeholder="Address"></x-input>
                </div>

                <div class="password">

                    <x-input name="password" type="password" required placeholder="Password"></x-input>

                </div>

                <div class="customer-image">
                    <x-input name="image" type="file" required placeholder="Upload Image"></x-input>
                </div>
                <div class="keep-login">
                    <div class="keep">
                        <input type="checkbox" name="remember" id="remember" style="width: 20px;height:20px;">
                        <label for="remember">Keep me logged in</label>
                    </div>
                    <div class="forget-password">
                        <a href="">Forgot password?</a>
                    </div>
                </div>


                <div class="loginbtn">
                    <x-button id="cancel" name="cancel" type="button">Cancel</x-button>
                    <x-button id="loginbtn" name="login" type="submit">Register</x-button>

                </div>
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>

            </form>

        </div>
    </div>




@endsection