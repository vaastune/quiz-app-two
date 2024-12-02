@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-decoration: underline;">Your Quiz Results</h1>

        @if ($results->isEmpty())
            <p>You haven't completed any quizzes yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>Score</th>
                        <th>Total</th>
                        <th>Test Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->quiz->title }}</td>
                            <td>{{ $result->score }}</td>
                            <td>{{ $result->total }}</td>
                            <td>{{ $result->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
