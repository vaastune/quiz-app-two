<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model
use App\Models\Quiz; // Import the Quiz model

class ResultsController extends Controller
{
    public function index()
{
    // Fetch the current user's results
    $results = Result::where('user_id', auth()->id())->latest()->get();
    return view('results.index', compact('results'));
}

}
