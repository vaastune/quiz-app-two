@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>
    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
        @csrf
        @foreach ($quiz->questions as $question)
            <div>
                <p>{{ $question->question }}</p>
                @foreach ($question->choices as $choice)
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}">
                        {{ $choice->text }}
                    </label>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-3">Submit Quiz</button>
    </form>
</div>
@endsection
