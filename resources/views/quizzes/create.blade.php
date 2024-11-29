@extends('layouts.app')

@section('title', 'Create Quiz')

@section('content')
<a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create Quiz</a>

<div class="container">
    <h1>Create a New Quiz</h1>
    <form method="POST" action="#">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Quiz Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
</div>
@endsection
