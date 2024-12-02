@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Question to {{ $quiz->title }}</h1>

    <form action="{{ route('quizzes.storeAdditionalQuestions', $quiz->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="question" class="form-label">Question:</label>
            <input type="text" name="question" class="form-control" required>
        </div>

        <!-- Choices inputs -->
        <div class="mb-3">
            <label for="choices" class="form-label">Choices:</label>
            @for ($i = 1; $i <= 4; $i++)
                <div class="input-group mb-2">
                    <input type="text" name="choices[]" class="form-control" required placeholder="Choice {{ $i }}">
                    <div class="input-group-text">
                        <input type="radio" name="correct" value="{{ $i }}" aria-label="Mark as correct choice">
                    </div>
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>
</div>
@endsection
