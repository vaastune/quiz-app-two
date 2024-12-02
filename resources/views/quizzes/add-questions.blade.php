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
        @foreach (range(1, 5) as $index)
            <div class="mb-3">
                <label for="question{{ $index }}" class="form-label">Question {{ $index }}:</label>
                <input type="text" name="questions[]" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="choices{{ $index }}" class="form-label">Choices:</label>
                @foreach (range(1, 4) as $choiceIndex)
                    <input type="text" name="choices[{{ $index - 1 }}][]" class="form-control mb-2" required placeholder="Choice {{ $choiceIndex }}">
                @endforeach
            </div>

            <div class="mb-3">
                <label for="correct{{ $index }}" class="form-label">Correct Choice:</label>
                <select name="correct[]" class="form-select" required>
                    <option value="">Select the correct choice</option>
                    @foreach (range(1, 4) as $choiceIndex)
                        <option value="{{ $choiceIndex }}">{{ 'Choice ' . $choiceIndex }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Add Questions</button>
    </form>


</div>
@endsection
