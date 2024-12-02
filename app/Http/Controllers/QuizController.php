<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question; // Import the Question model
use App\Models\Result; // Import the Result model

class QuizController extends Controller
{
    public function index()
{
    $quizzes = Quiz::all(); // Get all quizzes
    $result = auth()->user() ? auth()->user()->results()->latest()->first() : null; // Get the most recent result for the authenticated user

    return view('results.index', compact('quizzes', 'result'));
}


    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions()->with('choices')->get();

        return view('quizzes.take', compact('quiz', 'questions'));
    }

    public function create($quizId = null)
{
    $quiz = $quizId ? Quiz::findOrFail($quizId) : null; // Find the quiz if $quizId is provided

    return view('quizzes.create', compact('quiz'));
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Quiz::create([
            'title' => $request->title,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }

    public function addQuestions($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.add-questions', compact('quiz'));
    }

    public function storeAdditionalQuestions(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'choices' => 'required|array|min:2|max:4',
            'choices.*' => 'required|string|max:255',
        ]);

        $question = new Question();
        $question->text = $request->input('question');
        $question->quiz_id = $quiz->id;
        $question->save();

        foreach ($request->input('choices') as $index => $choiceText) {
            $isCorrect = false; // Placeholder logic for correct answer
            $question->choices()->create([
                'text' => $choiceText,
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('quizzes.addQuestions', $quiz->id)->with('success', 'Question added successfully!');
    }

    public function takeQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions()->with('choices')->get();

        return view('quizzes.take', compact('quiz', 'questions'));
    }

    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        // Mark the quiz as completed for the user
        auth()->user()->quizzes()->attach($quiz->id, ['completed_at' => now()]);

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

        Result::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
            'score' => $correctAnswers,
            'total' => $totalQuestions,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz submitted successfully!');
    }
}
