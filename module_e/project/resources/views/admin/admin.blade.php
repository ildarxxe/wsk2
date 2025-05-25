@extends('layouts.app')

@section('title', 'Админ панель')

@section('content')
    <div class="admin">
        <nav>
            <a href="/admin/polls">Опросы</a>
            <a href="/admin/categories">Категории</a>
        </nav>
    </div>
@endsection
