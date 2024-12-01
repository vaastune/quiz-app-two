<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz; // Import the Quiz model

class QuizController extends Controller
{
    // Method to display all quizzes and the latest result of the logged-in user
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
    public function addQuestions($id)
{
    $quiz = Quiz::findOrFail($id);
    return view('quizzes.add-questions', compact('quiz'));

}

}
