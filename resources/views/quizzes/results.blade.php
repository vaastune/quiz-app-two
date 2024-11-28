@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="text-success">Your Results</h1>
    <h3 class="mt-4">{{ $quiz->title }}</h3>
    <p class="lead">You scored <strong>{{ $result->score }}</strong> out of <strong>{{ $result->total }}</strong>.</p>
    <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Back to Quizzes</a>
</div>
@endsection
