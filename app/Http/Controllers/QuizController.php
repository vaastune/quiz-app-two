<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        // Validate the data if needed
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'questions.*.text' => 'required|string|max:255',
            'questions.*.choices.*' => 'required|string|max:255',
        ]);

        $quiz = Quiz::create(['title' => $request->title]);

        foreach ($request->input('questions') as $questionData) {
            $question = new Question();
            $question->text = $questionData['text'];
            $question->quiz_id = $quiz->id;

            // Save the question first
            $question->save();

            foreach ($questionData['choices'] as $choiceText) {
                $choice = new Choice(); // Assuming you have a Choice model
                $choice->text = $choiceText;
                $choice->question_id = $question->id;
                $choice->save();
            }
        }

        return redirect()->route('quizzes.index');
    }


    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $answer = $request->input("answers.{$question->id}");
            if ($answer == $question->correct_answer) {
                $score++;
            }
        }

        // Save the result
        Result::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total' => $totalQuestions,
        ]);

        return redirect()->route('quizzes.results', $quiz)->with('score', $score);
    }

    public function results(Quiz $quiz)
    {
        $result = $quiz->results()->where('user_id', auth()->id())->latest()->first();
        return view('quizzes.results', compact('result', 'quiz'));
    }
}
