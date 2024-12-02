<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model
use App\Models\Quiz; // Import the Quiz model

class ResultsController extends Controller
{
    public function index()
    {
        // Fetch the current user's results (modify as needed for your application)
        $result = Result::where('user_id', auth()->id())->latest()->first();

        // Pass both $result and $quizzes to the view
        $quizzes = Quiz::all();

        return view('results.index', compact('result', 'quizzes'));
    }
}
