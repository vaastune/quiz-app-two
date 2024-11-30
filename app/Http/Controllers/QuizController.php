<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Display a list of all quizzes
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    // Show a form to create a new quiz
    public function create()
    {
        return view('quizzes.create');
    }

    // Store a newly created quiz in the database
    public function store(Request $request)
    {
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
            $question->save();

            foreach ($questionData['choices'] as $choiceText) {
                $choice = new \App\Models\Choice(); // Assuming you have a Choice model
                $choice->text = $choiceText;
                $choice->question_id = $question->id;
                $choice->save();
            }
        }

        return redirect()->route('quizzes.index');
    }

    // Show the details of a specific quiz
    public function show($id)
    {
        $quiz = Quiz::with('questions.choices')->findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    // Display the form to add more questions to a quiz
    public function addQuestions($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.addQuestions', compact('quiz'));
    }

    // Store additional questions for an existing quiz
    public function storeAdditionalQuestions(Request $request, $id)
    {
        $validatedData = $request->validate([
            'questions.*.text' => 'required|string|max:255',
            'questions.*.choices.*' => 'required|string|max:255',
        ]);

        $quiz = Quiz::findOrFail($id);

        foreach ($request->input('questions') as $questionData) {
            $question = new Question();
            $question->text = $questionData['text'];
            $question->quiz_id = $quiz->id;
            $question->save();

            foreach ($questionData['choices'] as $choiceText) {
                $choice = new \App\Models\Choice(); // Assuming you have a Choice model
                $choice->text = $choiceText;
                $choice->question_id = $question->id;
                $choice->save();
            }
        }

        return redirect()->route('quizzes.show', ['id' => $quiz->id]);
    }
}
