@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <div class="login">
        <form action="{{route('admin.login')}}" method="POST">
            @csrf
            <div class="form_label">
                <label for="name">Введите логин:</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form_label">
                <label for="password">Введите пароль:</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit">Войти</button>
        </form>
    </div>
@endsection
