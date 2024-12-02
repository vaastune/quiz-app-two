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

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'choices' => 'required|array|min:2',
            'choices.*' => 'required|string|max:255',
        ]);

        $question = new Question();
        $question->text = $request->input('question');
        $question->save();

        // Save choices for the question
        foreach ($request->input('choices') as $choiceText) {
            $question->choices()->create([
                'text' => $choiceText,
                'is_correct' => false, // Adjust based on your needs
            ]);
        }

        return redirect()->route('quizzes.index')->with('success', 'Question created successfully!');
    }

}
