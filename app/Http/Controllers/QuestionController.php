<?php

use App\Models\Question;

class QuestionController extends Controller
{
    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string|max:255',
            'options.*.is_correct' => 'nullable|boolean',
        ]);

        $question = Question::create(['text' => $validated['text']]);

        foreach ($validated['options'] as $option) {
            $question->options()->create($option);
        }

        return redirect()->back()->with('success', 'Question and options saved successfully!');
    }
}
