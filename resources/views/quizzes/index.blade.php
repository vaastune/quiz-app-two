@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quizzes</h1>

    <!-- Category Filter -->
    <form action="{{ route('quizzes.index') }}" method="GET" class="mb-4">
        <label for="category">Filter by Category:</label>
        <select name="category" id="category" onchange="this.form.submit()" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Quiz List -->
    <div class="row">
        @forelse ($quizzes as $quiz)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $quiz->title }}</h5>
                        <p class="card-text">
                            Category: {{ $quiz->category->name ?? 'Uncategorized' }} <br>
                            Created by: {{ $quiz->user->name ?? 'Unknown' }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary">Take Quiz</a>

                            <!-- Delete Button -->
                            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No quizzes found for this category.</p>
        @endforelse
    </div>
</div>
@endsection
