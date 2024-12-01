@extends('layouts.app')

@section('content')
    <h1>Create New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Quiz Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <h2>Questions</h2>
        <div id="question-container">
            <div class="question-block">
                <div class="form-group">
                    <label for="question1">Question 1</label>
                    <input type="text" name="questions[0][text]" id="question1" class="form-control" required>
                </div>
                <label>Choices</label>
                <div class="form-group">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="form-check">
                            <input type="radio" name="questions[0][correct]" value="{{ $i }}" class="form-check-input" required>
                            <input type="text" name="questions[0][choices][]" class="form-control d-inline-block" placeholder="Choice {{ $i + 1 }}" required>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <button type="button" id="add-question" class="btn btn-primary mt-3">Add Question</button>
        <button type="submit" class="btn btn-success mt-3">Create Quiz</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const questionContainer = document.getElementById('question-container');
            const addQuestionButton = document.getElementById('add-question');
            let questionCount = 1;

            addQuestionButton.addEventListener('click', () => {
                const questionBlock = document.createElement('div');
                questionBlock.classList.add('question-block');
                questionBlock.innerHTML = `
                    <div class="form-group">
                        <label for="question${questionCount}">Question ${questionCount + 1}</label>
                        <input type="text" name="questions[${questionCount}][text]" id="question${questionCount}" class="form-control" required>
                    </div>
                    <label>Choices</label>
                    <div class="form-group">
                        ${[0, 1, 2, 3].map(i => `
                            <div class="form-check">
                                <input type="radio" name="questions[${questionCount}][correct]" value="${i}" class="form-check-input" required>
                                <input type="text" name="questions[${questionCount}][choices][]" class="form-control d-inline-block" placeholder="Choice ${i + 1}" required>
                            </div>
                        `).join('')}
                    </div>
                `;
                questionContainer.appendChild(questionBlock);
                questionCount++;
            });
        });
    </script>
@endsection
