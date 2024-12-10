<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $quizzes = Quiz::with('category')
            ->when($request->category, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->get();

        return view('quizzes.index', compact('quizzes', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('quizzes.create', compact('categories'));
    }

    public function myQuizzes()
    {
    // Logic to get and display the user's quizzes
    $quizzes = auth()->user()->quizzes; // Assuming you have a relationship set up in User model

    return view('quizzes.my', compact('quizzes'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'questions' => 'required|array|min:1|max:5',
            'questions.*' => 'required|string|max:255',
            'choices' => 'required|array|min:1|max:5',
            'choices.*' => 'required|array|min:2',
            'choices.*.*' => 'nullable|string|max:255',
            'correct' => 'required|array|min:1|max:5',
            'correct.*' => 'required|integer|min:1|max:4',
        ]);

        $quiz = Quiz::create([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->id(),
        ]);

        foreach ($request->input('questions') as $index => $questionText) {
            $question = $quiz->questions()->create(['question' => $questionText]);

            foreach ($request->input('choices')[$index] as $choiceIndex => $choiceText) {
                if (trim($choiceText) !== '') {
                    $isCorrect = $request->input('correct')[$index] == ($choiceIndex + 1);
                    $question->choices()->create([
                        'text' => $choiceText,
                        'is_correct' => $isCorrect,
                    ]);
                }
            }
        }

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }

    public function addQuestions($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions()->get();

        if ($questions->count() >= 5) {
            return redirect()->route('quizzes.show', $quiz->id)
                ->with('error', 'You can only add up to 5 questions per quiz.');
        }

        return view('quizzes.add-questions', compact('quiz', 'questions'));
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions; // Assuming there is a relationship set up in the Quiz model

        return view('quizzes.show', compact('quiz', 'questions'));
    }


    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }


    // Additional methods like `update`, `edit`, and submission-related logic here...
    public function submit(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $userAnswers = $request->input('answers');
        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $correctChoice = $question->choices()->where('is_correct', true)->first();

            if (isset($userAnswers[$question->id]) && $userAnswers[$question->id] == $correctChoice->id) {
                $score++;
            }
        }

        // Save the result to the database
        $result = new Result();
        $result->quiz_id = $quiz->id;
        $result->user_id = auth()->id();
        $result->score = $score;
        $result->total = $totalQuestions;
        $result->save();

        // Redirect to the results page
        return redirect()->route('results.show')->with('message', 'Quiz submitted successfully!');
    }



}
