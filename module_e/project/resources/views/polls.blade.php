<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Опрос</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<div class="polls public_polls">
    <div class="alert">
        <h2></h2>
    </div>
    <h1 class="title">Опрос</h1>
    <div class="poll">
        <h2>Название: {{$poll['title']}}</h2>
        <h3>Категория: {{$poll['category']}}</h3>
        <p>Описание: {{$poll['description']}}</p>
        <form class="questions">
            @csrf
            @foreach($poll['questions'] as $question)
                <h4>{{$question->question_text}}</h4>
                <div class="answers">
                    @foreach($question['answers'] as $answer)
                        <div class="answer">
                            @if($question['type'] === "single")
                                <input type="radio" name="{{$question['id']}}" id="answer{{$answer['id']}}" value="{{$answer['id']}}">
                                <label for="answer{{$answer['id']}}">
                                    {{$answer->answer_text}}
                                </label>
                            @else
                                <input type="checkbox" name="{{$question['id']}}" id="answer{{$answer['id']}}" value="{{$answer['id']}}">
                                <label for="answer{{$answer['id']}}">
                                    {{$answer->answer_text}}
                                </label>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
            <button class="send">Отправить</button>
        </form>
    </div>
</div>
<script src="{{asset('js/publicPolls.js')}}"></script>
</body>
</html>
