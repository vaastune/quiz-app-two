@extends('layouts.app')

@section('content')
    <h1>Quiz List</h1>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create New Quiz</a>
    <h1>Quizzes</h1>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>
                <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a>
            </li>
        @endforeach
    </ul>

    <ul>
        @foreach($quizzes as $quiz)
            <li>
                <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a>
                <a href="{{ route('quizzes.addQuestions', $quiz->id) }}" class="btn btn-sm btn-warning">Add Questions</a>
            </li>
        @endforeach
    </ul>
@endsection
