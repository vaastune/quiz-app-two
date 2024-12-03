<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result; // Import the Result model
use App\Models\Quiz; // Import the Quiz model

public function index()
{
    $user = auth()->user();
    $results = $user->results; // Assuming a 'results' relationship exists on the User model

    return view('results.index', compact('results'));
}


}
