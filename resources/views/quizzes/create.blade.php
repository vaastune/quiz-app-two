{{-- resources/views/quizzes/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Quiz')

@section('content')
    <h1>Create a New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <label for="title">Quiz Title:</label>
        <input type="text" name="title" id="title" required>

        <h3>Questions:</h3>
        <div id="questions">
            <div class="question">
                <label for="question_1">Question 1:</label>
                <input type="text" name="questions[0][text]" id="question_1" required>

                <h4>Choices:</h4>
                <div class="choices">
                    <input type="text" name="questions[0][choices][0][text]" placeholder="Choice 1" required>
                    <label>
                        <input type="checkbox" name="questions[0][choices][0][is_correct]"> Correct
                    </label>
                    <input type="text" name="questions[0][choices][1][text]" placeholder="Choice 2" required>
                    <label>
                        <input type="checkbox" name="questions[0][choices][1][is_correct]"> Correct
                    </label>
                    <!-- Add more choices as needed -->
                </div>
            </div>
        </div>

        <button type="submit">Create Quiz</button>
    </form>

@endsection
