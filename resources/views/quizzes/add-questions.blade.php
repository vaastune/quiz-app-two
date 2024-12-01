@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Questions for Quiz: {{ $quiz->title }}</h1>
    <form action="{{ route('quizzes.storeAdditionalQuestions', $quiz->id) }}" method="POST">
        @csrf
        <!-- Add your form fields here for questions -->
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
        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>

</div>
@endsection
