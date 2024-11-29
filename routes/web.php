<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
// web.php (routes file)
use App\Http\Controllers\QuizController;

Route::get('/quizzes', [QuizController::class, 'index']); // Show all quizzes
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']); // Show a single quiz
Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']); // Submit answers
Route::get('/quizzes/{quiz}/results', [QuizController::class, 'results'])->name('quizzes.results');
Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');

//Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::resource('quizzes', QuizController::class);
Auth::routes();


require __DIR__.'/auth.php';

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
