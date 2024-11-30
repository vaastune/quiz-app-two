<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function index()
{
    $results = Result::where('user_id', auth()->id())->get();
    return view('results.index', compact('results'));
}

}
