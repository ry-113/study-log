<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProgressController;
use App\Models\Lesson;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/chart-get', [ChartController::class, 'chartGet'])
    // ->name('chart-get');

    Route::get('/modules', [ModuleController::class, 'index'])
    ->name('modules.index');

    Route::get('/modules/{module_id}', [LessonController::class, 'index'])
    ->name('lessons.index');
    Route::get('/modules/lessons/{id}', [LessonController::class, 'show'])
    ->name('lessons.show');
    Route::get('/lesson/{lesson_id}/next',[LessonController::class, 'next'])
    ->name('lesson.next');

    Route::patch('/progress/update/{lesson_id}/{status}', [ProgressController::class, 'update'])
    ->name('progress.update');
    Route::post('/notify', [QuestionController::class, 'notify'])
    ->name('notify');
});

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])
->name('login.google');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
->name('login.google.callback');

require __DIR__.'/auth.php';
