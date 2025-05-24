<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Главная страница')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<header>
    <nav>
        @auth
            <a href="/admin/logout">Выйти</a>
        @endauth
        @guest
            <a href="/admin">Админ панель</a>
        @endguest
    </nav>
</header>
    @yield('content')
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</html>
