
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>We're glad to have you here. Enjoy exploring the quizzes!</p>
    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Start Quizzing</a>
    <img src="{{ asset('images]/3.gif') }}" alt="Welcome Image" class="img-fluid mt-4">
        <p class="mt-3">Start exploring and taking quizzes now!</p>


</div>
@endsection

<footer class="mt-4 text-center">
    <p>&copy; {{ date('2024') }} All rights reserved.</p>
</footer>
