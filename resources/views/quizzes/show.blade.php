@extends('layouts.app')

@section('title', 'Quiz: ' . $quiz->title)

@section('content')
    <h2>{{ $quiz->title }}</h2>
    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
        @csrf
        @foreach ($quiz->questions as $question)
            <div>
                <p>{{ $question->question }}</p>
                @foreach (json_decode($question->options) as $option)
                    <label>
                        <input type="radio" name="answer[{{ $question->id }}]" value="{{ $option }}">
                        {{ $option }}
                    </label><br>
                @endforeach
            </div>
        @endforeach
        <button type="submit">Submit</button>
    </form>
@endsection
