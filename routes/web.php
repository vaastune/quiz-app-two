<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;


// Public Routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authentication Routes
Auth::routes();

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quiz Routes
    Route::prefix('quizzes')->name('quizzes.')->group(function () {
        Route::get('/', [QuizController::class, 'index'])->name('index');
        Route::get('/create', [QuizController::class, 'create'])->name('create');
        Route::post('/', [QuizController::class, 'store'])->name('store');
        Route::get('/{quiz}', [QuizController::class, 'show'])->name('show');
        Route::get('/{quiz}/edit', [QuizController::class, 'edit'])->name('edit');
        Route::put('/{quiz}', [QuizController::class, 'update'])->name('update');
        Route::delete('/{quiz}', [QuizController::class, 'destroy'])->name('destroy');
        Route::get('/dashboard', [QuizController::class, 'index'])->name('dashboard');
        Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
        Route::get('/results', [QuizController::class, 'showResults'])->name('results.index');
        Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    });

    // My Quizzes Route
    Route::get('/my-quizzes', [QuizController::class, 'myQuizzes'])->name('my-quizzes');

    // Question Management
    Route::get('/{quiz}/add-questions', [QuizController::class, 'addQuestions'])->name('addQuestions');
    Route::post('/{quiz}/add-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('storeAdditionalQuestions');

    // Results Routes
    Route::get('/results', [ResultsController::class, 'index'])->name('results.index');

    // Admin Routes
    Route::middleware('isAdmin')->group(function () {
        // Admin-specific routes can go here if needed in the future.
    });

    Route::resource('categories', CategoryController::class);
});

