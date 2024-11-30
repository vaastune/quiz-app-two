<?php

use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Route;
// web.php (routes file)
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


use App\Http\Controllers\QuizController;

Route::resource('quizzes', QuizController::class);
Route::post('/quizzes/create', [QuizController::class, 'store'])->name('quizzes.store');

Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::get('quizzes/{id}/add-questions', [QuizController::class, 'addQuestions'])->name('quizzes.addQuestions');
Route::post('quizzes/{id}/store-questions', [QuizController::class, 'storeAdditionalQuestions'])->name('quizzes.storeAdditionalQuestions');
Route::get('/quizzes', [QuizController::class, 'index']); // Show all quizzes
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']); // Show a single quiz
Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']); // Submit answers
Route::get('/quizzes/{quiz}/results', [QuizController::class, 'results'])->name('quizzes.results');
Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::get('/quizzes/create', [App\Http\Controllers\QuizController::class, 'create'])->name('quizzes.create');
//Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');

Route::post('/quizzes/{id}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');

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
Route::get('/results', [ResultsController::class, 'index'])->name('results.index');

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');



Route::get('/', function () {
    return view('welcome'); // Make sure this matches the name of your Blade template
})->name('welcome');


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
