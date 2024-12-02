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
    // CRUD routes for quizzes (use resource if needed)
    Route::resource('quizzes', QuizController::class);

    // Additional routes for specific quiz functionalities
    Route::get('/quizzes/{quiz}/add-questions', [QuizController::class, 'addQuestions'])->name('quizzes.addQuestions');
    Route::post('/quizzes/{quiz}/store-questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/quizzes/{quiz}/submit', [QuizSubmissionController::class, 'store'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/results', [QuizController::class, 'results'])->name('quizzes.results');
    Route::get('/results', [ResultsController::class, 'index'])->name('results.index');
});

// Basic Auth Routes
Auth::routes();

// General routes
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
