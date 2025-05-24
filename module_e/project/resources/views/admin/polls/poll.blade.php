@extends('layouts.app')

@section('title', 'Опросы')

@section('content')
    <div class="polls">
        @if (session('message'))
            <div class="alert">
                <h2>{{session('message')}}</h2>
            </div>
        @endif
        <h1 class="title">Опрос</h1>
        <form action="{{route('create.link', ['id' => $poll['id']])}}" class="poll_form" method="POST">
            @csrf
            <button type="submit">Создать коротку ссылку</button>
        </form>
        <button class="showShortLinksBtn">Показать короткие ссылки</button>
        <ul class="short_links hidden">
            @foreach($poll['short_links'] as $link)
                <li><a target="_blank" href="http://127.0.0.1:8000/{{$link->short_code}}">http://127.0.0.1:8000/{{$link->short_code}}</a></li>
            @endforeach
        </ul>
        <div class="poll">
            <h2>Название: {{$poll['title']}}</h2>
            <h3>Категория: {{$poll['category']}}</h3>
            <p>Описание: {{$poll['description']}}</p>
            <div class="questions">
                @foreach($poll['questions'] as $question)
                    <h4>{{$question->question_text}}</h4>
                    <ul>
                        @foreach($question['answers'] as $answer)
                            <li>{{$answer->answer_text}}</li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{asset('js/polls.js')}}"></script>
@endsection
