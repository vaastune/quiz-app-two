@extends('layouts.app')

@section('title', 'Create Quiz')

@section('content')
<div class="container">
    <h1>Create a New Quiz</h1>
    <form method="POST" action="{{ route('quizzes.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Quiz Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
</div>
@endsection




{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Quiz Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div id="questions">
            <h3>Questions</h3>
            <div class="question mb-3">
                <label for="questions[0][text]" class="form-label">Question Text</label>
                <input type="text" name="questions[0][text]" class="form-control" required>
                <label for="questions[0][options][]" class="form-label">Options</label>
                <input type="text" name="questions[0][options][]" class="form-control" required>
                <input type="text" name="questions[0][options][]" class="form-control" required>
                <label for="questions[0][correct_answer]" class="form-label">Correct Option (0 or 1)</label>
                <input type="number" name="questions[0][correct_answer]" class="form-control" required>
            </div>
        </div>
        <button type="button" id="add-question" class="btn btn-secondary">Add Question</button>
        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
</div>

<script>
    document.getElementById('add-question').addEventListener('click', () => {
        const questionCount = document.querySelectorAll('.question').length;
        const newQuestion = `
            <div class="question mb-3">
                <label for="questions[${questionCount}][text]" class="form-label">Question Text</label>
                <input type="text" name="questions[${questionCount}][text]" class="form-control" required>
                <label for="questions[${questionCount}][options][]" class="form-label">Options</label>
                <input type="text" name="questions[${questionCount}][options][]" class="form-control" required>
                <input type="text" name="questions[${questionCount}][options][]" class="form-control" required>
                <label for="questions[${questionCount}][correct_answer]" class="form-label">Correct Option (0 or 1)</label>
                <input type="number" name="questions[${questionCount}][correct_answer]" class="form-control" required>
            </div>`;
        document.getElementById('questions').insertAdjacentHTML('beforeend', newQuestion);
    });
</script>
@endsection --}}



{{-- @extends('layouts.app')

@section('content')
<h1>Create a New Quiz</h1>
<form action="{{ route('quizzes.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Quiz Title" required>
    <button type="submit">Create</button>
</form>
@endsection --}}
