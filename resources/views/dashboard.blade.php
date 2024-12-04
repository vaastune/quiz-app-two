@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Dashboard</h2>

        @if($quizzes->count() > 0)
            <div class="card">
                <div class="card-header">Your Quizzes</div>
                <div class="card-body">
                    <ul>
                        @foreach($quizzes as $quiz)
                            <li>{{ $quiz->title }} (Category: {{ $quiz->category }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <p>You have not created any quizzes yet.</p>
        @endif
    </div>
@endsection
