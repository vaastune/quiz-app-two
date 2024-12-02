<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultsController;

Route::middleware('auth')->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::get('/quizzes/{id}/add-questions', [QuizController::class, 'addQuestions'])->name('quizzes.addQuestions');
    Route::get('/quizzes/{id}/take', [QuizController::class, 'takeQuiz'])->name('quizzes.take');
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submitAnswers'])->name('quizzes.submitAnswers');
    Route::post('/quizzes/{id}/complete', [QuizController::class, 'completeQuiz'])->name('quizzes.complete');
    Route::get('/results', [ResultsController::class, 'index'])->name('results.index');
    Route::post('/quizzes/{quiz}/add-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('quizzes.storeAdditionalQuestions');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Auth::routes();
