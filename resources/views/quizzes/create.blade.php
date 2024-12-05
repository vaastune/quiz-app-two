@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Quiz</h1>
        <form action="{{ route('quizzes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Quiz Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>



            <div id="questions-container">
                <div class="mb-3 question-section">
                    <label for="question-1" class="form-label">Question 1</label>
                    <input type="text" name="questions[]" id="question-1" class="form-control" required>

                    <label class="form-label">Choices</label>
                    <div class="mb-2 choices-container">
                        <input type="text" name="choices[0][]" class="form-control mb-1" placeholder="Choice 1" required>
                        <input type="text" name="choices[0][]" class="form-control mb-1" placeholder="Choice 2" required>
                        <input type="text" name="choices[0][]" class="form-control mb-1" placeholder="Choice 3" required>
                        <input type="text" name="choices[0][]" class="form-control mb-1" placeholder="Choice 4" required>
                    </div>

                    <label for="correct-1" class="form-label">Correct Choice (e.g., 1 for Choice 1)</label>
                    <input type="number" name="correct[]" id="correct-1" class="form-control" min="1" max="4" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create Quiz</button>

            <button type="button" id="add-question" class="btn btn-secondary mb-3">Add Another Question</button>
            <button type="submit" class="btn btn-primary">Create Quiz</button>
        </form>
    </div>

    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            let questionContainer = document.getElementById('questions-container');
            let questionIndex = questionContainer.querySelectorAll('.question-section').length + 1;

            let newQuestionHTML = `
                <div class="mb-3 question-section">
                    <label for="question-${questionIndex}" class="form-label">Question ${questionIndex}</label>
                    <input type="text" name="questions[]" id="question-${questionIndex}" class="form-control" required>

                    <label class="form-label">Choices</label>
                    <div class="mb-2 choices-container">
                        <input type="text" name="choices[${questionIndex - 1}][]" class="form-control mb-1" placeholder="Choice 1" required>
                        <input type="text" name="choices[${questionIndex - 1}][]" class="form-control mb-1" placeholder="Choice 2" required>
                        <input type="text" name="choices[${questionIndex - 1}][]" class="form-control mb-1" placeholder="Choice 3" required>
                        <input type="text" name="choices[${questionIndex - 1}][]" class="form-control mb-1" placeholder="Choice 4" required>
                    </div>

                    <label for="correct-${questionIndex}" class="form-label">Correct Choice (e.g., 1 for Choice 1)</label>
                    <input type="number" name="correct[]" id="correct-${questionIndex}" class="form-control" min="1" max="4" required>
                </div>
            `;

            questionContainer.insertAdjacentHTML('beforeend', newQuestionHTML);
        });
    </script>
@endsection
