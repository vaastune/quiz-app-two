@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>
    @foreach($quiz->questions as $question)
    <div>
        <p>{{ $question->question }}</p>
        <ul>
            @foreach($question->choices as $choice)
                <li>{{ $choice->text }}</li>
            @endforeach
        </ul>
    </div>
    @endforeach <!-- This should match the opening @foreach loop -->
    <button type="submit" class="btn btn-primary mt-3">Submit Quiz</button>
</div>
@endsection
