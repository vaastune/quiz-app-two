<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Category;
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
        $categories = Category::all();
        return view('quizzes.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id', // Ensure this is present and correct
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


    public function storeAdditionalQuestions(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $this->validateAdditionalQuestions($request);

        $this->storeQuestionsAndChoices($request, $quiz);

        return redirect()->route('quizzes.addQuestions', $quiz->id)
            ->with('success', 'Questions added successfully!');
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions.choices')->findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->only('title'));

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully!');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
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

    public function takeQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions()->with('choices')->get();

        return view('quizzes.take', compact('quiz', 'questions'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $this->validateSubmission($request, $quiz);

        $score = $this->calculateScore($quiz, $request);

        Result::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total' => $quiz->questions()->count(),
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Your answers have been recorded!');
    }

    public function showResults($id)
    {
        $quiz = Quiz::with('questions.choices')->findOrFail($id);
        $results = Result::where('quiz_id', $quiz->id)
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('quizzes.results', compact('quiz', 'results'));
    }

    private function validateQuiz(Request $request)
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
    }

    private function validateAdditionalQuestions(Request $request)
    {
        $request->validate([
            'questions' => 'required|array|min:1|max:5',
            'questions.*' => 'required|string|max:255',
            'choices' => 'required|array|min:1|max:5',
            'choices.*' => 'required|array|min:2',
            'choices.*.*' => 'required|string|max:255',
            'correct' => 'required|array|min:1|max:5',
            'correct.*' => 'required|integer|min:1|max:4',
        ]);
    }

    private function storeQuestionsAndChoices(Request $request, Quiz $quiz)
    {
        foreach ($request->input('questions') as $index => $questionText) {
            $question = $quiz->questions()->create([
                'question' => $questionText,
            ]);

            $choices = $request->input('choices')[$index];
            $correctChoiceIndex = $request->input('correct')[$index] - 1;

            foreach ($choices as $choiceIndex => $choice) {
                if (trim($choice) !== '') {
                    $isCorrect = $choiceIndex === $correctChoiceIndex;

                    $question->choices()->create([
                        'text' => $choice,
                        'is_correct' => $isCorrect,
                    ]);
                }
            }
        }
    }

    private function validateSubmission(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer',
        ]);
    }

    private function calculateScore(Quiz $quiz, Request $request)
    {
        $score = 0;

        foreach ($quiz->questions as $question) {
            $correctChoice = $question->choices()->where('is_correct', true)->first();
            if ($request->input("answers.{$question->id}") == $correctChoice->id) {
                $score++;
            }
        }

        return $score;
    }
}
