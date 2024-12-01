@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create a New Question</h2>
    <form method="POST" action="{{ route('questions.store') }}">
        @csrf
        <div class="mb-3">
            <label for="question" class="form-label">Question Text</label>
            <input type="text" name="text" id="question" class="form-control" required>
        </div>

        <div id="options-container">
            <h4>Options</h4>
            <div class="option">
                <input type="text" name="options[0][text]" placeholder="Option text" class="form-control mb-2" required>
                <label>
                    <input type="checkbox" name="options[0][is_correct]" value="1"> Correct
                </label>
            </div>
        </div>

        <button type="button" id="add-option" class="btn btn-secondary">Add Another Option</button>
        <button type="submit" class="btn btn-primary mt-3">Save Question</button>
    </form>
</div>

<script>
    let optionCount = 1;
    document.getElementById('add-option').addEventListener('click', () => {
        const container = document.getElementById('options-container');
        const optionHTML = `
            <div class="option">
                <input type="text" name="options[${optionCount}][text]" placeholder="Option text" class="form-control mb-2" required>
                <label>
                    <input type="checkbox" name="options[${optionCount}][is_correct]" value="1"> Correct
                </label>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', optionHTML);
        optionCount++;
    });
</script>
@endsection
