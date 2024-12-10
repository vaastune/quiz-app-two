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
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary">Take Quiz</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No quizzes found for this category.</p>
        @endforelse
    </div>
</div>
@endsection


{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Quiz List</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ $quiz->level }}</td>
                        <td>
                            <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}


