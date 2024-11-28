@extends('layouts.layout')

@section('title', 'Quiz List')

@section('content')
    <h1>All Quizzes</h1>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>
                <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create New Quiz</a>
@endsection
