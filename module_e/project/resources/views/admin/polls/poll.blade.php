@extends('layouts.app')

@section('title', 'Опрос')

@section('content')
    <div class="polls">
        <h1 class="title">Опрос</h1>
        <div class="poll_options">
            <button class="create">Редактировать</button>
            <form action="{{route('link.create', ['id' => $poll['id']])}}" method="POST" class="create_link_form">
                @csrf
                <button type="submit">Создать ссылку на опрос</button>
            </form>
            <p>Посмотреть список ссылок</p>
            <form action="{{route('poll.delete', ['id' => $poll['id']])}}" class="poll_delete" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete" type="submit">Удалить опрос</button>
            </form>
        </div>
        <ul class="links hidden">
            @foreach($poll['links'] as $link)
                <li>
                    <a target="_blank" href="http://127.0.0.1:8000/{{$link->short_code}}">http://127.0.0.1:8000/{{$link->short_code}}</a>
                    <form action="{{route('link.delete', ['id' => $link->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete_link">Удалить</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <div class="poll">
            <h2>Категория: {{$poll['category']}}</h2>
            <h2>Название: {{$poll['title']}}</h2>
            <p>Описание: {{$poll['description']}}</p>
            <div class="questions">
                @foreach($poll['questions'] as $question)
                    <div class="question_box">
                        <h2>{{$question->question_text}}</h2>
                        <div class="answers">
                            @foreach($question['answers'] as $answer)
                                <div class="answer_box">
                                    <p>{{$answer['answer_text']}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{asset('js/poll.js')}}"></script>
@endsection
