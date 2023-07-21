<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSelectorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SemesterSelectorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TopicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', function () {
    return redirect()->route('questions.index');
})->name('home');

Route::resource('questions', QuestionController::class)->only(['index']);
Route::post('change_course', CourseSelectorController::class)->name('change_course');
Route::post('change_semester', SemesterSelectorController::class)->name('change_semester');


Route::middleware('auth')->group(function () {
    Route::resource('semesters', SemesterController::class)->only(['index']);
    Route::resource('courses', CourseController::class)->only(['index']);
    Route::resource('chapters', ChapterController::class)->only(['index']);
    Route::resource('topics', TopicController::class);
    Route::resource('questions', QuestionController::class)->except(['index']);
    Route::resource('multiple-question', \App\Http\Controllers\MultipleQuestionController::class);
    Route::post('questions/{question}/read', [QuestionController::class, 'read'])->name('questions.read');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
