<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultsController;

Route::middleware('auth')->group(function () {
    // Quiz Routes
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::get('/quizzes/{quiz}/take', [QuizController::class, 'take'])->name('quizzes.take');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
    Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
    // Question Management
    Route::get('/quizzes/{quiz}/add-questions', [QuizController::class, 'addQuestions'])->name('quizzes.addQuestions');
    Route::post('/quizzes/{quiz}/add-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('quizzes.storeAdditionalQuestions');

    // Results
    Route::get('/results', [ResultsController::class, 'index'])->name('results.index');
});

// Home Page and Dashboard
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication Routes
Auth::routes();
