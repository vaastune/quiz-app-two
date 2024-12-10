@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Quiz Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <h3>Questions</h3>
        <div id="questions-container">
            <div class="form-group">
                <label for="question-1">Question 1:</label>
                <input type="text" class="form-control" id="question-1" name="questions[]" required>
            </div>

            <div class="form-group">
                <label>Choices for Question 1:</label>
                <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 1" required>
                <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 2" required>
                <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 3" required>
                <input type="text" class="form-control" name="choices[0][]" placeholder="Choice 4" required>
            </div>

            <!-- Repeat for additional questions as needed -->
        </div>

        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
</div>
@endsection
