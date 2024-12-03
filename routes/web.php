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
    Route::get('/quizzes/{quiz}/take', [QuizController::class, 'take'])->name('quizzes.take');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::post('/quizzes/{id}/complete', [QuizController::class, 'completeQuiz'])->name('quizzes.complete');
    Route::get('/results', [ResultsController::class, 'index'])->name('results.index');
    Route::post('/quizzes/{quiz}/add-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('quizzes.storeAdditionalQuestions');
    Route::get('/quizzes/{quiz}/add-questions', [QuizController::class, 'addQuestions'])->name('quizzes.addQuestions');
    Route::post('/quizzes/{quiz}/store-additional-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('quizzes.storeAdditionalQuestions');
    Route::post('/quizzes/{quiz}/complete', [QuizController::class, 'completeQuiz'])->name('quizzes.complete');
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submitAnswers'])->name('quizzes.submit');
    Route::resource('quizzes', QuizController::class);
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Auth::routes();
