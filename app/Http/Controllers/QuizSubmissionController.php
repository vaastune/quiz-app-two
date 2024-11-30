<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;

class QuizSubmissionController extends Controller
{
    public function submit(Request $request, $quizId)
    {
        // Validate the submission
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer',
        ]);

        // Fetch the quiz and its questions
        $quiz = Quiz::with('questions.choices')->findOrFail($quizId);

        // Calculate the score
        $calculatedScore = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $selectedChoiceId = $validated['answers'][$question->id] ?? null;
            $correctChoice = $question->choices->where('is_correct', true)->first();

            if ($correctChoice && $selectedChoiceId == $correctChoice->id) {
                $calculatedScore++;
            }
        }

        // Save the result
        $result = Result::create([
            'quiz_id' => $quizId,
            'user_id' => auth()->id(),
            'score' => $calculatedScore,
            'total' => $totalQuestions,
        ]);

        return redirect()->route('results.index')->with('success', 'Quiz submitted successfully!');
    }
}
