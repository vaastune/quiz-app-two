@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>

    @foreach($quiz->questions as $index => $question)
        <div class="mb-3">
            <h3>Question {{ $index + 1 }}: {{ $question->question }}</h3>
            <ul>
                @foreach($question->choices as $choice)
                    <li>{{ $choice->text }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
