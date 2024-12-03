@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4" style="text-decoration: underline;">Quiz List</h1>
        <a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-4">Create New Quiz</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2 style="text-decoration: underline;">Available Quizzes</h2>
        <div class="list-group">
            @forelse ($quizzes as $quiz)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span><strong>{{ $quiz->title }}</strong></span>
                    <div>
                        <!-- Take Quiz Button -->
                        <a href="{{ route('quizzes.take', $quiz->id) }}" class="btn btn-success btn-sm">Take Quiz</a>

                        <!-- Delete Quiz Form -->
                        <form method="POST" action="{{ route('quizzes.destroy', $quiz->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No quizzes available yet. Create one!</p>
            @endforelse
        </div>

        <!-- Results Section -->
        <div class="mt-5">
            <h2 style="text-decoration: underline;">Your Results</h2>
            @if ($result)
                <p>Congratulations! You scored {{ $result->score }} out of {{ $result->total }}.</p>
            @else
                <p>You haven't completed any quizzes yet.</p>
            @endif
        </div>
    </div>
@endsection
