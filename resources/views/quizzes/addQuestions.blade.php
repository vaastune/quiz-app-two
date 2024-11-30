@extends('layouts.app')

@section('content')
    <h1>Add Questions to "{{ $quiz->title }}"</h1>
    <form action="{{ route('quizzes.storeAdditionalQuestions', $quiz->id) }}" method="POST">
        @csrf
        <div id="question-container">
            @foreach($quiz->questions as $index => $question)
                <div class="form-group">
                    <label for="question{{ $index }}">Question {{ $index + 1 }}</label>
                    <input type="text" name="questions[{{ $index }}][text]" id="question{{ $index }}" class="form-control" value="{{ $question->text }}" required>
                    <label>Choices</label>
                    @foreach($question->choices as $choice)
                        <input type="text" name="questions[{{ $index }}][choices][]" class="form-control mb-2" placeholder="Choice" value="{{ $choice->text }}" required>
                    @endforeach
                    <button type="button" class="btn btn-info mt-2 add-choice" data-index="{{ $index }}">Add Choice</button>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Questions</button>
    </form>
    <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary mt-2">Back to Quiz</a>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-choice').forEach(function(button) {
            button.addEventListener('click', function() {
                var index = button.dataset.index;
                var newChoice = document.createElement('input');
                newChoice.type = 'text';
                newChoice.name = `questions[${index}][choices][]`;
                newChoice.className = 'form-control mb-2';
                newChoice.placeholder = 'New Choice';
                button.parentElement.insertBefore(newChoice, button);
            });
        });
    });
</script>
@endsection
