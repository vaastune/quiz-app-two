<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizSubmissionController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;

// Routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{id}/add-questions', [QuizController::class, 'addQuestions'])->name('quizzes.addQuestions');
    Route::post('/quizzes/{id}/store-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('quizzes.storeAdditionalQuestions');
    Route::post('/quizzes/{quiz}/submit', [QuizSubmissionController::class, 'store'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/results', [QuizController::class, 'results'])->name('quizzes.results');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/quizzes/{id}/take', [QuizController::class, 'takeQuiz'])->name('quizzes.take');
    Route::post('/quizzes/{id}/complete', [QuizController::class, 'completeQuiz'])->name('quizzes.complete');
    Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submitAnswers'])->name('quizzes.submitAnswers');
    Route::get('/results', [ResultsController::class, 'index'])->name('results.index');
});

// Basic Auth Routes
Auth::routes();

// General routes
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Resource route for quizzes (handles index, show, edit, update, destroy)
Route::resource('quizzes', QuizController::class);

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
