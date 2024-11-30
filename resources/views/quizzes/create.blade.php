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

        <!-- Add fields for questions and choices -->
        <div id="questions-container">
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" id="question" name="questions[0][text]" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Choices:</label>
                <input type="text" name="questions[0][choices][]" class="form-control" placeholder="Choice 1" required>
                <input type="text" name="questions[0][choices][]" class="form-control" placeholder="Choice 2" required>
                <input type="text" name="questions[0][choices][]" class="form-control" placeholder="Choice 3" required>
                <input type="text" name="questions[0][choices][]" class="form-control" placeholder="Choice 4" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
@endsection
