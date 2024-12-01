@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Take Quiz: {{ $quiz->title }}</h1>
    <form action="{{ route('quizzes.submitAnswers', $quiz->id) }}" method="POST">
        @csrf
        @foreach($questions as $index => $question)
            <div class="mb-3">
                <label>{{ $index + 1 }}. {{ $question->text }}</label>
                <div>
                    @foreach($question->choices as $choice)
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" class="form-check-input" id="choice{{ $choice->id }}" required>
                            <label class="form-check-label" for="choice{{ $choice->id }}">{{ $choice->text }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit Answers</button>
    </form>
</div>
@endsection
