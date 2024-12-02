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

        <!-- Choices inputs -->
        <div class="mb-3">
            <label for="choice1" class="form-label">Choice 1</label>
            <input type="text" class="form-control" id="choice1" name="choices[]" required>
            <div>
                <label for="correct1" class="form-check-label">Is this the correct choice?</label>
                <input type="checkbox" class="form-check-input" id="correct1" name="correct[]" value="1">
            </div>
        </div>

        <div class="mb-3">
            <label for="choice2" class="form-label">Choice 2</label>
            <input type="text" class="form-control" id="choice2" name="choices[]" required>
            <div>
                <label for="correct2" class="form-check-label">Is this the correct choice?</label>
                <input type="checkbox" class="form-check-input" id="correct2" name="correct[]" value="2">
            </div>
        </div>

        <div class="mb-3">
            <label for="choice3" class="form-label">Choice 3</label>
            <input type="text" class="form-control" id="choice3" name="choices[]">
            <div>
                <label for="correct3" class="form-check-label">Is this the correct choice?</label>
                <input type="checkbox" class="form-check-input" id="correct3" name="correct[]" value="3">
            </div>
        </div>

        <div class="mb-3">
            <label for="choice4" class="form-label">Choice 4</label>
            <input type="text" class="form-control" id="choice4" name="choices[]">
            <div>
                <label for="correct4" class="form-check-label">Is this the correct choice?</label>
                <input type="checkbox" class="form-check-input" id="correct4" name="correct[]" value="4">
            </div>
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
