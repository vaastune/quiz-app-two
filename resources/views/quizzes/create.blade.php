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
            <div class="form-group">
                <label for="question1">Question 1</label>
                <input type="text" name="questions[0][text]" id="question1" class="form-control" required>
                <label>Choices</label>
                <input type="text" name="questions[0][choices][]" class="form-control mb-2" placeholder="Choice 1" required>
                <input type="text" name="questions[0][choices][]" class="form-control mb-2" placeholder="Choice 2" required>
                <input type="text" name="questions[0][choices][]" class="form-control mb-2" placeholder="Choice 3" required>
                <input type="text" name="questions[0][choices][]" class="form-control mb-2" placeholder="Choice 4" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create Quiz</button>
    </form>
@endsection
