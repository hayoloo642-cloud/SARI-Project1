<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Admin — SARI</title>
</head>
<body>
    <h1>Panel Admin SARI</h1>
    <p>Login sebagai: {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Keluar</button>
    </form>
</body>
</html>
