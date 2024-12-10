@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-decoration: underline;">Your Results</h1>

    <!-- Form to enter the classroom pin -->
    <form action="{{ route('results.show') }}" method="POST">
        @csrf
        <label for="classroom_pin">Enter Classroom Pin:</label>
        <input type="text" id="classroom_pin" name="classroom_pin" required>
        <button type="submit">Submit</button>
    </form>

    <!-- Display error message if any -->
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Display results if they exist -->
    @if(isset($results))
        <h2>Your Quiz Results</h2>
        @foreach($results as $result)
            <p>Quiz: {{ $result->quiz->title }} - Score: {{ $result->score }} / {{ $result->total }}</p>
        @endforeach
    @else
        <p>Welcome, {{ auth()->user()->name }}!</p>
        <p>You haven't completed any quizzes yet.</p>
    @endif

    <!-- Original results table -->
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
    @endif
</div>
@endsection
