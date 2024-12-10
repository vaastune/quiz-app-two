<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuizResult; // Replace with your actual model

class ResultAccessController extends Controller
{
    public function showResults(Request $request)
    {
        $request->validate([
            'classroom_pin' => 'required|string',
        ]);

        // Find the user by classroom pin
        $user = User::where('classroom_pin', $request->classroom_pin)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid classroom pin.');
        }

        // Fetch results for the authenticated user
        $results = QuizResult::where('user_id', $user->id)->get();

        return view('results.index', compact('results'));
    }
}
