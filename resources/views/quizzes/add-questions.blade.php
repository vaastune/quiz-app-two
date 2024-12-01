@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Questions for Quiz: {{ $quiz->title }}</h1>
    <form action="{{ route('quizzes.storeAdditionalQuestions', $quiz->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <div class="mb-3">
            <label for="choice1" class="form-label">Choice 1</label>
            <input type="text" class="form-control" id="choice1" name="choices[]" required>
        </div>
        <div class="mb-3">
            <label for="choice2" class="form-label">Choice 2</label>
            <input type="text" class="form-control" id="choice2" name="choices[]" required>
        </div>
        <!-- Additional choices can be added as needed -->
        <div class="mb-3">
            <label for="correct_choice" class="form-label">Correct Choice Index (0 for first, 1 for second, etc.)</label>
            <input type="number" class="form-control" id="correct_choice" name="correct_choice" min="0" max="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>

    <!-- Save button for completing the quiz -->
    <form action="{{ route('quizzes.complete', $quiz->id) }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-success">Save and Complete Quiz</button>
    </form>
</div>
@endsection
