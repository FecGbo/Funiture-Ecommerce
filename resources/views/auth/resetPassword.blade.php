@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/auth/forgetpass.css') }}">
@section('content')

    <div class="banner">
        <div class="banner-content">
            <h1>Contact</h1>
            <div class="title">
                <a href="">Home</a>
                <span>></span>
                <span>Reset Password</span>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="content-left">
            <img src="{{ asset('images/login.png') }}" alt="">
        </div>
        <div class="content-right">
           
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <h1>Reset Password</h1>
                        <p>
                    Forgot your password? Just let us know you email address and we will send you a password reset link that
                    will allow you to choose a new one.
                </p>

                <input type="hidden" name="token" value="{{ $token }}">
                <x-input type="hidden" name="email" value="{{$email}}"></x-input>
                <x-input type="password" name="password" required placeholder="New Password"></x-input>
                <x-input type="password" name="password_confirmation" required placeholder="Confirm Password"></x-input>
                <x-button id="loginbtn" type="submit">Reset Password</x-button>
            </form>
            @if($errors->any())
            <div>{{ $errors->first() }}</div> @endif

        </div>
    </div>




@endsection