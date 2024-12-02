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

    <form action="{{ route('quizzes.storeAdditionalQuestions', $quiz->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="question" class="form-label">Question:</label>
            <input type="text" name="question" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="choices" class="form-label">Choices:</label>
            <input type="text" name="choices[]" class="form-control mb-2" required placeholder="Choice 1">
            <input type="text" name="choices[]" class="form-control mb-2" required placeholder="Choice 2">
            <input type="text" name="choices[]" class="form-control mb-2" required placeholder="Choice 3">
            <input type="text" name="choices[]" class="form-control mb-2" required placeholder="Choice 4">
        </div>

        <div class="mb-3">
            <label for="correct" class="form-label">Correct Choice:</label>
            <select name="correct" class="form-select" required>
                <option value="">Select the correct choice</option>
                <option value="1">Choice 1</option>
                <option value="2">Choice 2</option>
                <option value="3">Choice 3</option>
                <option value="4">Choice 4</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>

</div>
@endsection
