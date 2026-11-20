<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — SARI Panel Admin</title>
</head>
<body>
    <h1>Masuk Panel Admin SARI</h1>

    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf
        <p>
            <label>Email<br>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
        </p>
        <p>
            <label>Password<br>
            <input type="password" name="password" required></label>
        </p>
        <p>
            <label><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        </p>
        <p><button type="submit">Masuk</button></p>
    </form>
</body>
</html>
