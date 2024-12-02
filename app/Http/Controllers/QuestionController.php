<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request, $quizId)
{
    $request->validate([
        'question' => 'required|string|max:255',
        'choices' => 'required|array|min:2|max:4', // Limit the choices to 4
        'choices.*' => 'required|string|max:255',
    ]);

    $quiz = Quiz::findOrFail($quizId); // Get the quiz the question belongs to

    $question = new Question();
    $question->text = $request->input('question');
    $question->quiz_id = $quiz->id; // Set the quiz_id
    $question->save();

    // Save choices for the question
    foreach ($request->input('choices') as $choiceText) {
        $question->choices()->create([
            'text' => $choiceText,
            'is_correct' => false, // Adjust logic as needed for correct answers
        ]);
    }

    return redirect()->route('quizzes.addQuestions', $quiz->id)->with('success', 'Question added successfully!');
}

}
