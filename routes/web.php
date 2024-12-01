<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizSubmissionController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;

Route::middleware('auth')->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
});


// Basic Auth Routes
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

// Quiz Routes
Route::resource('quizzes', QuizController::class);
Route::get('/quizzes/{id}/add-questions', [QuizController::class, 'addQuestions'])->name('quizzes.addQuestions');
Route::post('/quizzes/{id}/store-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('quizzes.storeAdditionalQuestions');
Route::post('/quizzes/{quiz}/submit', [QuizSubmissionController::class, 'store'])->name('quizzes.submit');
Route::get('/quizzes/{quiz}/results', [QuizController::class, 'results'])->name('quizzes.results');

// Results Routes
Route::get('/results', [ResultsController::class, 'index'])->name('results.index');

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Auth-specific routes (optional)
require __DIR__.'/auth.php';
