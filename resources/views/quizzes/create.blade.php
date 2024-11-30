{{-- resources/views/quizzes/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Quiz')

@section('content')
    <h1>Create a New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Quiz Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <!-- Add more fields for questions, choices, etc. -->
        <div class="form-group">
            <label for="question">Question:</label>
            <input type="text" id="question" name="question" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
@endsection
