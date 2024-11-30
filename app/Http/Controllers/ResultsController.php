<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function index()
    {
        // Logic for displaying results
        return view('results.index'); // Ensure you have a Blade file at resources/views/results/index.blade.php
    }
}
