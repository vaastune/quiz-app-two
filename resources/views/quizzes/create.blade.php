@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Create a New Quiz</h1>

    <!-- Example for adding choices to a question -->
    <form action="{{ route('questions.store', ['quizId' => $quiz->id]) }}" method="post">

        @csrf

        <div id="question-container">
            <div class="question">
                <label for="question">Question:</label>
                <input type="text" name="question" id="question" class="form-control" required>

                <label for="choices">Choices:</label>
                <div id="choices-container">
                    <div class="choice">
                        <input type="text" name="choices[]" class="form-control mb-2" placeholder="Choice" required>
                        <button type="button" class="btn btn-danger remove-choice">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-choice" class="btn btn-primary mt-2">Add Choice</button>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>

    <script>
        document.getElementById('add-choice').addEventListener('click', function() {
            const choiceContainer = document.createElement('div');
            choiceContainer.classList.add('choice');
            choiceContainer.innerHTML = `
                <input type="text" name="choices[]" class="form-control mb-2" placeholder="Choice" required>
                <button type="button" class="btn btn-danger remove-choice">Remove</button>
            `;
            document.getElementById('choices-container').appendChild(choiceContainer);

            choiceContainer.querySelector('.remove-choice').addEventListener('click', function() {
                choiceContainer.remove();
            });
        });
    </script>
</div>

@endsection
