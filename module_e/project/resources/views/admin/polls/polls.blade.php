@extends('layouts.app')

@section('title', 'Опросы')

@section('content')
    <div class="polls">
        <h1 class="title">Опросы</h1>
        <button class="create">Создать опрос</button>
        @foreach($polls as $poll)
            <div class="poll_box">
                <a href="/admin/polls/{{$poll['id']}}">{{$poll['title']}}</a>
            </div>
        @endforeach
    </div>
    <script src="{{asset('js/categories.js')}}"></script>
@endsection
