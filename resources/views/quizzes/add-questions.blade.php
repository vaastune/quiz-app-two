@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Questions to Quiz: {{ $quiz->title }}</h1>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for adding a new question -->
    <form action="{{ route('quizzes.storeAdditionalQuestions', $quiz->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="question" class="form-label">Question:</label>
            <input type="text" name="question" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Choices:</label>
            <input type="text" name="choices[]" class="form-control mb-2" required placeholder="Choice 1">
            <input type="text" name="choices[]" class="form-control mb-2" required placeholder="Choice 2">
            <input type="text" name="choices[]" class="form-control mb-2" placeholder="Choice 3">
            <input type="text" name="choices[]" class="form-control mb-2" placeholder="Choice 4">
        </div>

        <div class="mb-3">
            <label for="correct" class="form-label">Correct Answer (Number):</label>
            <input type="number" name="correct" class="form-control" min="1" max="4" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>

    <!-- Submit Quiz button -->
    <form action="{{ route('quizzes.complete', $quiz->id) }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-success">Submit Quiz</button>
    </form>
</div>
@endsection
