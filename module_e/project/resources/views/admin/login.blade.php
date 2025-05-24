@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <div class="login">
        @if (session('message'))
            <div class="alert">
                <h2>{{session('message')}}</h2>
            </div>
        @endif
        <form action="{{route('admin.login')}}" method="POST">
            @csrf
            <div class="form_label">
                <label for="name">Логин:</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form_label">
                <label for="password">Пароль:</label>
                <input type="text" name="password" id="password">
            </div>
            <button type="submit">Войти</button>
        </form>
    </div>
@endsection
