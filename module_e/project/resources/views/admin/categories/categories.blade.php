@extends('layouts.app')

@section('title', 'Категории опросов')

@section('content')
    <div class="categories">
        @if (session('message'))
            <div class="alert">
                <h2>{{session('message')}}</h2>
            </div>
        @endif
        <h1 class="title">Категории</h1>
            <form action="{{route('create.category')}}" method="POST">
                <h1>Создать новую категорию</h1>
                @csrf
                <div class="form_label">
                    <label for="title">Введите название категории:</label>
                    <input type="text" name="title" id="title">
                    <button type="submit">Создать</button>
                </div>
            </form>
        @foreach($categories as $category)
            <div class="category_box">
                <h2>{{$category['title']}}</h2>
                <form action="{{route('update.category', ['id' => $category['id']])}}" class="hidden" method="POST">
                    @csrf
                    <div class="form_label">
                        <input type="text" name="title" value="{{$category['title']}}">
                    </div>
                    <button type="submit" class="save">Сохранить</button>
                </form>
                <button class="change">Изменить</button>
            </div>
        @endforeach
    </div>
    <script src="{{asset('js/categories.js')}}"></script>
@endsection
