<?php
// app/Http/Controllers/ResultsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model

class ResultsController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all(); // Adjust as needed based on your application
        $result = auth()->user()->results()->latest()->first(); // Example of fetching the latest result
        return view('results.index', compact('quizzes', 'result'));
    }

}

