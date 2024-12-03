
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>We're glad to have you here. Enjoy exploring the quizzes!</p>
    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Start Quizzing</a>
</div>
@endsection
