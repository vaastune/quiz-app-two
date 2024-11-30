@extends('layouts.app')

@section('content')
    <h1>{{ $quiz->title }}</h1>

    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
        @csrf

        @foreach($quiz->questions as $index => $question)
            <div class="question">
                <p>{{ $index + 1 }}. {{ $question->text }}</p>

                @foreach($question->choices as $choice)
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}">
                        {{ $choice->text }}
                    </label><br>
                @endforeach
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
