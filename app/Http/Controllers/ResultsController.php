<?php
// app/Http/Controllers/ResultsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model

class ResultsController extends Controller
{
    public function index()
    {
        $results = Result::where('user_id', auth()->id())->get();
        return view('results.index', compact('results'));
    }
}

