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
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <h1>Forget Password</h1>

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

                <p>
                    Forgot your password? Just let us know you email address and we will send you a password reset link that
                    will allow you to choose a new one.
                </p>

                <div class="email">

                    <x-input name="email" type="email" required placeholder="Email Address"></x-input>

                </div>



                <div class="sent-mail">
                    <x-button id="loginbtn" name="login" type="submit">Sent</x-button>
                    <x-button id="loginbtn" name="login" type="submit">Back</x-button>
                </div>





            </form>

        </div>
    </div>




@endsection