<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch quizzes ordered by category or class
        $quizzes = Quiz::orderBy('category')->get();

        return view('dashboard', compact('quizzes'));
    }
}
