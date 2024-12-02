@extends('layouts.app')

@section('content')

<!-- Quiz List Section -->
<div class="container">
    <h1 style="text-decoration: underline;">Quiz List</h1>
    <br>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-3">Create New Quiz</a>
    <br>

    <h2 style="text-decoration: underline;">Available Quizzes</h2>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>
                <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a>
                <a href="{{ route('quizzes.addQuestions', $quiz->id) }}" class="btn btn-sm btn-warning">Add Questions</a>
            </li>
        @endforeach
    </ul>
</div>

<!-- Results Section -->
<div class="container mt-4">
    <h1 style="text-decoration: underline;">Your Results</h1>
    @if ($result)
        <p>Congratulations! You scored {{ $result->score }} out of {{ $result->total }}.</p>
    @else
        <p>You haven't completed any quizzes yet.</p>
    @endif
</div>

@endsection
