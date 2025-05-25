@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <div class="categories">
        <h1 class="title">Категории</h1>
        <button class="create">Создать категорию</button>
        <form action="{{route('category.create')}}" method="POST" class="hidden create_category">
            @csrf
            <input type="text" name="title" id="title" placeholder="Название категории">
            <button type="submit">Создать</button>
        </form>
        @foreach($categories as $category)
            <div class="category_box">
                <div class="category_box--text">
                    <h2>Категория: {{$category['title']}}</h2>
                    <p class="change">Изменить</p>
                </div>
                <form action="{{route('category.update', ['id' => $category['id']])}}" method="POST" class="hidden">
                    @csrf
                    <input type="text" name="title" id="title" value="{{$category['title']}}">
                    <button type="submit">Сохранить</button>
                </form>
            </div>
        @endforeach
    </div>
    <script src="{{asset('js/categories.js')}}"></script>
@endsection
