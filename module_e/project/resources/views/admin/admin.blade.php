@extends('layouts.app')

@section('title', 'Админ панель')

@section('content')
    <div class="admin">
        @if (session('message'))
            <div class="alert">
                <h2>{{session('message')}}</h2>
            </div>
        @endif
        <div class="admin_links">
            <a href="/admin/polls">Опросы</a>
            <a href="/admin/categories">Категории опросов</a>
        </div>
    </div>
@endsection
