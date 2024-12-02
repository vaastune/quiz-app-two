@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Quiz</h1>
        <form action="{{ route('quizzes.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Quiz Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Create Quiz</button>
        </form>
    </div>
@endsection
