@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Dashboard</h2>

        @if($quizzes->count() > 0)
            <div class="card">
                <div class="card-header">Your Quizzes</div>
                <div class="card-body">
                    <ul>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Total Quizzes</h5>
                                        <p>{{ \App\Models\Quiz::count() }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Total Categories</h5>
                                        <p>{{ \App\Models\Category::count() }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Total Users</h5>
                                        <p>{{ \App\Models\User::count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

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
