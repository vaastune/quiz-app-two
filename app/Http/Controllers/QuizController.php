<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz; // Import the Quiz model

class QuizController extends Controller
{
// app/Http/Controllers/QuizController.php
public function index()
{
    $quizzes = Quiz::all(); // Get all quizzes
    $result = auth()->user() ? auth()->user()->quizResults()->latest()->first() : null; // Get the latest quiz result for the authenticated user

    return view('quizzes.index', compact('quizzes', 'result'));
}


    // Method to show a form to create a new quiz
    public function create()
    {
        return view('quizzes.create');
    }

    // Method to store a newly created quiz in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Create a new quiz with the validated title
        Quiz::create([
            'title' => $request->title,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }
    public function takeQuiz($id)
{
    $quiz = Quiz::findOrFail($id);
    $questions = $quiz->questions()->with('choices')->get();

    return view('quizzes.take', compact('quiz', 'questions'));
}



    public function storeAdditionalQuestions(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        // Validate the input data
        $request->validate([
            'question' => 'required|string|max:255',
            'choices' => 'required|array|min:2',
            'choices.*' => 'required|string|max:255',
            'correct_choice' => 'required|in:0,' . implode(',', array_keys($request->input('choices'))),
        ]);

        // Create a new question and associate it with the quiz
        $question = $quiz->questions()->create([
            'text' => $request->input('question'),
        ]);

        // Save choices for the question
        foreach ($request->input('choices') as $index => $choiceText) {
            $isCorrect = ($index == $request->input('correct_choice'));

            $question->choices()->create([
                'text' => $choiceText,
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('quizzes.addQuestions', $quiz->id)->with('success', 'Question added successfully!');
    }

    public function submitQuiz(Request $request, $id)
{
    $quiz = Quiz::findOrFail($id);

    // Optionally, validate and process answers here

    // Mark the quiz as completed for the user
    auth()->user()->quizzes()->attach($quiz->id, ['completed_at' => now()]);

    return redirect()->route('quizzes.index')->with('success', 'Quiz completed successfully!');
}
public function show($id)
{
    $quiz = Quiz::findOrFail($id);
    $questions = $quiz->questions()->with('choices')->get();

    return view('quizzes.take', compact('quiz', 'questions'));
}



    public function addQuestions($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.add-questions', compact('quiz'));
    }

    public function completeQuiz($id)
{
    $quiz = Quiz::findOrFail($id);
    // Additional logic to mark the quiz as complete, e.g., updating the `completed` column or handling status

    return redirect()->route('quizzes.index')->with('success', 'Quiz completed successfully!');
}
public function submitAnswers(Request $request, $id)
{
    $quiz = Quiz::findOrFail($id);
    $answers = $request->input('answers');
    $totalQuestions = $quiz->questions()->count();
    $correctAnswers = 0;

    foreach ($quiz->questions as $question) {
        $selectedChoiceId = $answers[$question->id] ?? null;
        $choice = $question->choices()->find($selectedChoiceId);

        if ($choice && $choice->is_correct) {
            $correctAnswers++;
        }
    }

    // Save the result to the database
    Result::create([
        'quiz_id' => $quiz->id,
        'user_id' => auth()->id(),
        'score' => $correctAnswers,
        'total' => $totalQuestions,
    ]);

    return redirect()->route('quizzes.index')->with('success', 'Quiz submitted successfully!');
}



}
