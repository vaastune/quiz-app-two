@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Questions for Quiz: {{ $quiz->title }}</h1>
    <form action="{{ route('quizzes.storeAdditionalQuestions', $quiz->id) }}" method="POST">
        @csrf
        <!-- Question Input -->
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>

        <!-- Choices Input -->
        <div class="mb-3">
            <label for="choice1" class="form-label">Choice 1</label>
            <input type="text" class="form-control" id="choice1" name="choices[0]" required>
        </div>
        <div class="mb-3">
            <label for="choice2" class="form-label">Choice 2</label>
            <input type="text" class="form-control" id="choice2" name="choices[1]" required>
        </div>

        <!-- Add more choices as needed -->

        <!-- Correct Choice Selection -->
        <div class="mb-3">
            <label for="correct_choice" class="form-label">Correct Choice</label>
            <select class="form-select" id="correct_choice" name="correct_choice" required>
                <option value="0">Choice 1</option>
                <option value="1">Choice 2</option>
                <!-- Add more options for additional choices -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>
</div>
@endsection
