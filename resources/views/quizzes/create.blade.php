@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Quiz</h1>
        <form method="POST" action="{{ route('quizzes.store') }}">
            @csrf
            <label for="quiz-title">Quiz Title:</label>
            <input type="text" name="title" id="quiz-title" required>

            <div id="questions-section">
                <div class="question-block">
                    <label>Question:</label>
                    <input type="text" name="questions[]" required>

                    <label>Choices:</label>
                    <div>
                        <input type="text" name="choices[0][]" placeholder="Choice 1" required>
                        <input type="text" name="choices[0][]" placeholder="Choice 2" required>
                        <input type="text" name="choices[0][]" placeholder="Choice 3">
                        <input type="text" name="choices[0][]" placeholder="Choice 4">
                    </div>

                    <label>Correct Answer (1-4):</label>
                    <input type="number" name="correct[]" min="1" max="4" required>
                </div>
            </div>

            <button type="button" id="add-question">Add Another Question</button>
            <button type="submit">Create Quiz</button>
        </form>

        <script>
            document.getElementById('add-question').addEventListener('click', function () {
                const questionsSection = document.getElementById('questions-section');
                const index = questionsSection.children.length;

                const questionBlock = `
                <div class="question-block">
                    <label>Question:</label>
                    <input type="text" name="questions[]" required>

                    <label>Choices:</label>
                    <div>
                        <input type="text" name="choices[${index}][]" placeholder="Choice 1" required>
                        <input type="text" name="choices[${index}][]" placeholder="Choice 2" required>
                        <input type="text" name="choices[${index}][]" placeholder="Choice 3">
                        <input type="text" name="choices[${index}][]" placeholder="Choice 4">
                    </div>

                    <label>Correct Answer (1-4):</label>
                    <input type="number" name="correct[]" min="1" max="4" required>
                </div>`;

                questionsSection.insertAdjacentHTML('beforeend', questionBlock);
            });
        </script>

    </div>
@endsection
