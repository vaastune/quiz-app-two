<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model
use App\Models\Quiz;   // Import the Quiz model

class ResultsController extends Controller
{
    public function index()
    {
        // Fetch all quizzes to show them on the results page
        $quizzes = Quiz::all();

        // Pass the quizzes variable to the view
        return view('results.index', compact('quizzes'));
    }
}
