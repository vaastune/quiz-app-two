@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
        @csrf
        @foreach($questions as $index => $question)
            <div class="mb-3">
                <label>{{ $index + 1 }}. {{ $question->text }}</label><br>
                @foreach($question->choices as $choice)
                    <div>
                        <label>
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" required>
                            {{ $choice->text }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Submit Answers</button>
    </form>
</div>
@endsection
