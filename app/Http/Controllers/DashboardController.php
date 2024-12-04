<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $quizzes = Quiz::query();

    if ($request->has('sort')) {
        $quizzes->orderBy('created_at', $request->input('sort'));
    }

    if ($request->has('category')) {
        $quizzes->where('category', $request->input('category'));
    }

    $quizzes = $quizzes->get();

    return view('dashboard', compact('quizzes'));
}

}
