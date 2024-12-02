@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-decoration: underline;">Your Results</h1>

    @if ($results && $results->count() > 0)
        <table class="table">
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
    @else
        <p>You haven't completed any quizzes yet.</p>
    @endif
</div>
@endsection
