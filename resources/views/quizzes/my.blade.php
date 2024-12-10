@extends('layouts.app')

@section('title', 'My Quizzes')

@section('content')
<h1>My Quizzes</h1>
<a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-3">Create New Quiz</a>
<ul>
    @foreach($quizzes as $quiz)
        <li>
            <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a> - Created on {{ $quiz->created_at->format('M d, Y') }}
        </li>
    @endforeach
</ul>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Quizzes</h1>

    <!-- Button to create a new quiz -->
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-3">Create New Quiz</a>

    @if($quizzes->count() > 0)
        <ul>
            @foreach($quizzes as $quiz)
                <li>
                    <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a> - Created on {{ $quiz->created_at->format('M d, Y') }}
                </li>
            @endforeach
        </ul>
    @else
        <p>You have not created any quizzes yet.</p>
    @endif
</div>
@endsection --}}
