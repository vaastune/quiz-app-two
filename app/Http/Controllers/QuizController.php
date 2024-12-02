<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

class QuizController extends Controller
{
    public function storeAdditionalQuestions(Request $request, $quizId)
    {
        // Fetch the quiz by ID or fail if not found
        $quiz = Quiz::findOrFail($quizId);

        // Validate the request data
        $request->validate([
            'question' => 'required|string|max:255', // The main question is required
            'choices' => 'required|array|min:2',    // At least two choices are required
            'choices.*' => 'required|string|max:255', // Each choice must be a valid string
            'correct' => 'required|integer|min:1|max:' . count($request->input('choices')), // Correct choice must be valid
        ]);
        dd($request->input('choices'));

        // Create the question and associate it with the quiz
        $question = new Question();
        $question->quiz_id = $quiz->id; // Link the question to the quiz
        $question->question = $request->input('question'); // Set the question text
        $question->save();

        // Add the choices for the question
        foreach ($request->input('choices') as $index => $choice) {
            $question->choices()->create([
                'text' => $choice, // The choice text
                'is_correct' => ($request->input('correct') == $index + 1), // Match the correct choice
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Question added successfully!');
    }




    public function index()
    {
        $quizzes = Quiz::all();

        // Fetch the result for the currently authenticated user
        $result = Result::where('user_id', auth()->id())->first(); // or use 'latest()' to get the most recent result

        return view('quizzes.index', compact('quizzes', 'result'));
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    public function create()
    {
        return view('quizzes.create');
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

    public function takeQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions()->with('choices')->get();

        return view('quizzes.take', compact('quiz', 'questions'));
    }

    public function completeQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        // Add any additional logic here as needed, such as marking the quiz as complete.

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
        // Result::create([...]); // Uncomment this if you have a Result model

        return redirect()->route('quizzes.index')->with('success', 'Quiz submitted successfully!');
    }
}
