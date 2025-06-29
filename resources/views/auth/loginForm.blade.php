<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
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
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="">Register here</a></p>
</body>

</html>