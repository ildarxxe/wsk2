@extends('layouts.app')

@section('title', 'Опросы')

@section('content')
    <div class="polls">
        @if (session('message'))
            <div class="alert">
                <h2>{{session('message')}}</h2>
            </div>
        @endif
        <h1 class="title">Опросы</h1>
        @foreach($polls as $poll)
            <div class="poll_box">
                <a href="/admin/polls/{{$poll['id']}}">{{$poll['title']}}</a>
            </div>
        @endforeach
    </div>
@endsection
