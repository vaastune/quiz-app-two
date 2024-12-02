@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Quiz Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div id="choices-container">
            <div class="choice">
                <input type="text" name="choices[]" class="form-control" placeholder="Choice">
            </div>
        </div>
        <button type="button" id="add-choice" class="btn btn-secondary">Add Choice</button>

        <script>
            document.getElementById('add-choice').addEventListener('click', function() {
                const container = document.getElementById('choices-container');
                const newChoice = document.createElement('div');
                newChoice.classList.add('choice');
                newChoice.innerHTML = '<input type="text" name="choices[]" class="form-control" placeholder="Choice">';
                container.appendChild(newChoice);
            });
        </script>


        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
</div>
@endsection
