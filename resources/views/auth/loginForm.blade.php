@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@section('content')

    <div class="banner">
        <div class="banner-content">
            <h1>Contact</h1>
            <div class="title">
                <a href="">Home</a>
                <span>></span>
                <span>Login</span>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="content-left">
            <img src="{{ asset('images/login.png') }}" alt="">
        </div>
        <div class="content-right">
            <form action="{{ route('auth.login') }}" method="post">
                @csrf
                <h1>Login</h1>
                <hr>
                @if(session('error'))
                    <div style="color:red;">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div style="color:green;">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div style="color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="email">

                    <x-input name="email" type="email" required placeholder="Email Address"></x-input>

                </div>
                <div class="password">

                    <x-input name="password" type="password" required placeholder="Password"></x-input>

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



                <x-button id="loginbtn" name="login" type="submit">Log in</x-button>
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>

            </form>

        </div>
    </div>




@endsection