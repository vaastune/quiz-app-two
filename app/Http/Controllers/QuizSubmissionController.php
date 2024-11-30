<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Result;

class QuizSubmissionController extends Controller
{
    public function store(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $totalQuestions = $quiz->questions()->count();
        $correctAnswers = 0;

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
            'total' => $totalQuestions,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz submitted successfully!');
    }
}
