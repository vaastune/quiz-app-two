<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model
use App\Models\Quiz; // Import the Quiz model

class ResultsController extends Controller
{
    public function index()
    {
        // Fetch all results for the authenticated user, ordered by the test date
        $results = Result::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        // Pass the results to the view
        return view('results.index', compact('results'));
    }
}
