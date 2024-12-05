<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and their email matches the admin email
        if (Auth::check() && Auth::user()->email === 'throwawayacc24356889@gmail.com') {
            return $next($request);
        }

        // Redirect non-admin users to a different route (e.g., the quizzes index or home page)
        return redirect()->route('quizzes.index')->with('error', 'You do not have permission to access this page.');
    }
}
