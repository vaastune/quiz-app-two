<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model
use App\Models\Quiz;   // Import the Quiz model

class ResultsController extends Controller
{
    public function index()
{
    $result = auth()->user()->quizResults()->latest()->first();

    return view('results.index', compact('result'));
}

}
