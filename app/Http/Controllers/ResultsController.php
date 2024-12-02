<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model
use App\Models\Quiz;   // Import the Quiz model

class ResultsController extends Controller
{
    public function index()
    {
        // Logic for displaying results (e.g., fetching the current user's results)
        return view('results.index');
    }
}
