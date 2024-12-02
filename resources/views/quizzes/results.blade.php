@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-decoration: underline;">Your Results</h1>

        <!-- Display a message if there are no results -->
        @if (!isset($results) || $results->isEmpty())
            <p>You haven't completed any quizzes yet.</p>
        @else
            <!-- Display a table of quiz results -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>Score</th>
                        <th>Total</th>
                        <th>Date Taken</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->quiz->title }}</td>
                            <td>{{ $result->score }}</td>
                            <td>{{ $result->total }}</td>
                            <td>{{ $result->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
