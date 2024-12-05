@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
    @else
        <h1>Welcome, Guest!</h1>
    @endauth

    <p>We're glad to have you here. Enjoy exploring the quizzes!</p>

    {{-- <title>{{ config('app.name', 'Quiz Platform') }}</title> --}}

    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Start Quizzing</a>

    <img src="{{ asset('images/c161526363f848444b4370f09237f94d.jpg') }}" alt="Welcome Image" class="img-fluid mt-4">

    <p class="mt-3">Start exploring and taking quizzes now!</p>
</div>

@endsection

<footer class="mt-4 text-center">
    <p>&copy; {{ date('Y') }} All rights reserved.</p>
</footer>


{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>We're glad to have you here. Enjoy exploring the quizzes!</p>
    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Start Quizzing</a>
    <img src="{{ asset('images]/c161526363f848444b4370f09237f94d.jpg') }}" alt="Welcome Image" class="img-fluid mt-4">
        <p class="mt-3">Start exploring and taking quizzes now!</p>


</div>
@endsection

<footer class="mt-4 text-center">
    <p>&copy; {{ date('2024') }} All rights reserved.</p>
</footer> --}}
