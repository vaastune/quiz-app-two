@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Take Quiz: {{ $quiz->title }}</h1>
        <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
            @csrf
            @foreach ($quiz->questions as $question)
                <div class="mb-4">
                    <p><strong>{{ $loop->iteration }}. {{ $question->question }}</strong></p>
                    @foreach ($question->choices as $choice)
                        <div>
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" id="choice-{{ $choice->id }}">
                            <label for="choice-{{ $choice->id }}">{{ $choice->text }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
