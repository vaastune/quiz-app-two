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
        @for ($i = 0; $i < 5; $i++)
            <div class="mb-3">
                <label for="question_{{ $i }}" class="form-label">Question {{ $i + 1 }}:</label>
                <input type="text" name="questions[{{ $i }}]" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="choices_{{ $i }}" class="form-label">Choices for Question {{ $i + 1 }}:</label>
                @for ($j = 0; $j < 4; $j++)
                    <input type="text" name="choices[{{ $i }}][] " class="form-control mb-2" required placeholder="Choice {{ $j + 1 }}">
                @endfor
            </div>

            <div class="mb-3">
                <label for="correct_{{ $i }}" class="form-label">Correct Choice for Question {{ $i + 1 }}:</label>
                <select name="correct[{{ $i }}]" class="form-select" required>
                    <option value="">Select the correct choice</option>
                    @for ($j = 1; $j <= 4; $j++)
                        <option value="{{ $j }}">Choice {{ $j }}</option>
                    @endfor
                </select>
            </div>
        @endfor

        <button type="submit" class="btn btn-primary">Add Questions</button>
    </form>

</div>
@endsection
