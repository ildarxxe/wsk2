<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Главная страница')</title>
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<header>
    <nav>
        @auth
            <a href="/admin/logout">Выйти</a>
            <a href="/admin">Админ панель</a>
        @endauth
        @guest
            <a href="/admin/login">Админ панель</a>
        @endguest
    </nav>
</header>
    @if (session('message'))
        <div class="alert">
            <h1>{{session('message')}}</h1>
        </div>
    @endif
    @yield('content')
</body>
</html>
