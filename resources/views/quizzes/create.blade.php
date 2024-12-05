@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Quiz</h1>
        <form method="POST" action="{{ route('quizzes.store') }}">
            @csrf
            <div class="mb-3">
                <label for="quiz-title" class="form-label">Quiz Title:</label>
                <input type="text" class="form-control" name="title" id="quiz-title" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select class="form-select" name="category_id" id="category" required>
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="questions-section">
                <div class="question-block mb-3">
                    <label>Question:</label>
                    <input type="text" class="form-control" name="questions[]" required>

                    <label>Choices:</label>
                    <div>
                        <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 1" required>
                        <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 2" required>
                        <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 3">
                        <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 4">
                    </div>

                    <label>Correct Answer (1-4):</label>
                    <input type="number" class="form-control" name="correct[]" min="1" max="4" required>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="add-question">Add Another Question</button>
            <button type="submit" class="btn btn-primary">Create Quiz</button>
        </form>

        <script>
            document.getElementById('add-question').addEventListener('click', function () {
                const questionsSection = document.getElementById('questions-section');
                const index = questionsSection.children.length;
                const questionBlock = `
                    <div class="question-block mb-3">
                        <label>Question:</label>
                        <input type="text" class="form-control" name="questions[]" required>

                        <label>Choices:</label>
                        <div>
                            <input type="text" class="form-control" name="choices[${index}][]" placeholder="Choice 1" required>
                            <input type="text" class="form-control" name="choices[${index}][]" placeholder="Choice 2" required>
                            <input type="text" class="form-control" name="choices[${index}][]" placeholder="Choice 3">
                            <input type="text" class="form-control" name="choices[${index}][]" placeholder="Choice 4">
                        </div>

                        <label>Correct Answer (1-4):</label>
                        <input type="number" class="form-control" name="correct[]" min="1" max="4" required>
                    </div>`;
                questionsSection.insertAdjacentHTML('beforeend', questionBlock);
            });
        </script>
    </div>
@endsection
