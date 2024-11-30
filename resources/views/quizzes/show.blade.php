@extends('layouts.app')

@section('content')
    <h1>{{ $quiz->title }}</h1>

    @foreach($quiz->questions as $index => $question)
        <div class="question">
            <h3>Question {{ $index + 1 }}: {{ $question->text }}</h3>
            <ul>
                @foreach($question->choices as $choice)
                    <li>{{ $choice->text }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach

    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Back to Quizzes</a>
@endsection
