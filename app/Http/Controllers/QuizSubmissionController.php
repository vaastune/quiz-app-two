<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;

class QuizSubmissionController extends Controller
{
    public function store(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId); // Fetch the quiz
        $totalQuestions = $quiz->questions()->count(); // Count total questions
        $correctAnswers = 0;

        // Check each answer
        foreach ($quiz->questions as $question) {
            $selectedChoiceId = $request->input('answers.' . $question->id);
            $choice = $question->choices()->find($selectedChoiceId);

            if ($choice && $choice->is_correct) {
                $correctAnswers++;
            }
        }

        $calculatedScore = $correctAnswers;

        // Save the result to the database
        Result::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
            'score' => $calculatedScore,
            'total' => $totalQuestions, // Store total questions
        ]);

        // Redirect after submission
        return redirect()->route('quizzes.index')->with('success', 'Quiz submitted successfully!');
    }
}
