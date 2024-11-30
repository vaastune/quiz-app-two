@extends('layouts.app')

@section('content')
    <h1>Quiz List</h1>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create New Quiz</a>

    <h2>Quizzes</h2>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>
                <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a>
                <a href="{{ route('quizzes.addQuestions', $quiz->id) }}" class="btn btn-sm btn-warning">Add Questions</a>
            </li>
        @endforeach
    </ul>

    <!-- Results Section -->
    <div class="container">
        @if ($result)
            <h1>Your Results</h1>
            <p>Congratulations! You scored {{ $result->score }} out of {{ $result->total }}.</p>
        @else
            <h1>Your Results</h1>
            <p>You haven't completed any quizzes yet.</p>
        @endif
    </div>
@endsection
