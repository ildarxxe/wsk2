<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Опрос</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="polls">
    <h1 class="title">Опрос</h1>
    <div class="poll">
        <h2>Категория: {{$poll['category']}}</h2>
        <h2>Название: {{$poll['title']}}</h2>
        <p>Описание: {{$poll['description']}}</p>
        <form class="public_poll_form">
            @csrf
            <div class="questions">
                @foreach($poll['questions'] as $question)
                    <div class="question_box">
                        <h2>{{$question->question_text}}</h2>
                        <div class="answers">
                            @foreach($question['answers'] as $answer)
                                <div class="answer_box">
                                    @if ($question['type'] === 'single')
                                        <input type="radio" name="{{$question['id']}}" value="{{$answer['id']}}" id="answer{{$answer['id']}}">
                                        <label for="answer{{$answer['id']}}">
                                            {{$answer->answer_text}}
                                        </label>
                                    @else
                                        <input type="checkbox" name="{{$question['id']}}" value="{{$answer['id']}}" id="answer{{$answer['id']}}">
                                        <label for="answer{{$answer['id']}}">
                                            {{$answer->answer_text}}
                                        </label>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="send">Завершить опрос</button>
        </form>
    </div>
</div>
<script src="{{asset('js/publicPoll.js')}}"></script>
</body>
</html>
