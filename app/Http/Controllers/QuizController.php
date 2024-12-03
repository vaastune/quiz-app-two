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
        $quiz = Quiz::findOrFail($quizId);

        // Validate the request data
        $request->validate([
            'questions' => 'required|array|min:1|max:5',
            'questions.*' => 'required|string|max:255',
            'choices' => 'required|array|min:1|max:5',
            'choices.*' => 'required|array|min:2',
            'choices.*.*' => 'required|string|max:255', // Each individual choice must be a non-empty string.
            'correct' => 'required|array|min:1|max:5',
            'correct.*' => 'required|integer|min:1|max:4',
        ]);

        // Loop through each question and save it along with choices
foreach ($request->input('questions') as $index => $questionText) {
    $question = new Question();
    $question->quiz_id = $quiz->id;
    $question->question = $questionText;
    $question->save();

    // Get choices for the current question
    $choices = $request->input('choices')[$index];
    $correctChoiceIndex = $request->input('correct')[$index] - 1; // Convert 1-based to 0-based index

    // Add choices and set the correct answer flag
    foreach ($choices as $choiceIndex => $choice) {
        // Ensure choice is not empty before creating
        if (trim($choice) !== '') {
            $isCorrect = $choiceIndex === $correctChoiceIndex;

            $question->choices()->create([
                'text' => $choice,
                'is_correct' => $isCorrect,
            ]);
        }
    }
}


        return redirect()->route('quizzes.addQuestions', $quiz->id)
            ->with('success', 'Questions added successfully!');
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
        // Log the input data for debugging purposes
        \Log::info('Questions:', $request->input('questions'));
        \Log::info('Choices:', $request->input('choices'));
        \Log::info('Choices for question ' . $index, $request->input('choices')[$index]);

        // Check if the request contains questions and choices
        // if (!$request->has('questions') || !$request->has('choices')) {
        //     return back()->withErrors(['error' => 'Questions and choices are required']);
        // }

        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:1|max:5',
            'questions.*' => 'required|string|max:255',
            'choices' => 'required|array|min:1|max:5',
            'choices.*' => 'required|array|min:2',
            'choices.*.*' => 'nullable|string|max:255',
            'correct' => 'required|array|min:1|max:5',
            'correct.*' => 'required|integer|min:1|max:4',
        ]);

        // Create a new quiz entry
        $quiz = Quiz::create(['title' => $request->input('title')]);

        // Iterate through each question and add it to the quiz
        foreach ($request->input('questions') as $index => $questionText) {
            $question = $quiz->questions()->create(['question' => $questionText]);

            // Iterate through each choice for the current question
            foreach ($request->input('choices')[$index] as $choiceIndex => $choiceText) {
                if (!empty(trim($choiceText))) {
                    $isCorrect = $choiceIndex === ($request->input('correct')[$index] - 1);
                    $question->choices()->create([
                        'text' => $choiceText,
                        'is_correct' => $isCorrect,
                    ]);
                }
            }


        // Redirect back to the quiz index page with a success message
        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully and ready to be taken!');
    }


//     return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully and ready to be taken!');
// }


    public function addQuestions($id)
    {
        $quiz = Quiz::findOrFail($id);

        // Fetch existing questions to check if we already have 5 questions
        $questions = $quiz->questions()->get();

        // Check if there are already 5 questions; if so, redirect or show a message
        if ($questions->count() >= 5) {
            return redirect()->route('quizzes.show', $quiz->id)->with('error', 'You can only add up to 5 questions per quiz.');
        }

        return view('quizzes.add-questions', compact('quiz', 'questions'));
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
    public function destroy($id)
{
    $quiz = Quiz::findOrFail($id);
    $quiz->delete();

    return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
}
public function take($id)
{
    $quiz = Quiz::with('questions.choices')->findOrFail($id);

    return view('quizzes.take', compact('quiz'));
}

public function submit(Request $request, $id)
{
    $quiz = Quiz::findOrFail($id);

    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required|integer',
    ]);

    $questions = $quiz->questions;
    $score = 0;

    foreach ($questions as $question) {
        $correctChoice = $question->choices()->where('is_correct', true)->first();
        if ($request->input("answers.{$question->id}") == $correctChoice->id) {
            $score++;
        }
    }

    Result::create([
        'user_id' => auth()->id(),
        'quiz_id' => $quiz->id,
        'score' => $score,
        'total' => $questions->count(),
    ]);

    return redirect()->route('quizzes.index')->with('success', 'Your answers have been recorded!');
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
