@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Take Quiz: {{ $quiz->title }}</h1>
    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
        @csrf
        @foreach ($quiz->questions as $question)
            <div class="mb-3">
                <label class="form-label">{{ $question->text }}</label>
                @foreach ($question->choices as $choice)
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" required>
                        <label class="form-check-label">{{ $choice->text }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
