<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ChartController;
use App\Models\Subject;
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

    Route::get('/records/create', [RecordController::class, 'create'])
    ->name('records.create');
    Route::post('/records/create', [RecordController::class, 'store'])
    ->name('records.store');
    Route::get('/records', [RecordController::class, 'index'])
    ->name('records.index');
    Route::get('/records/board', [RecordController::class, 'board'])
    ->name('records.board');
    Route::get('/records/{record}', [RecordController::class, 'edit'])
    ->name('records.edit');
    Route::put('/records/edit', [RecordController::class, 'update'])
    ->name('records.update');
    Route::delete('/records/delete', [RecordController::class, 'destroy'])
    ->name('records.delete');

    Route::get('/subjects', [SubjectController::class, 'index'])
    ->name('subjects.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])
    ->name('subjects.create');
    Route::post('/subjects/create', [SubjectController::class, 'store'])
    ->name('subjects.store');
    Route::delete('/subjects/delete', [SubjectController::class, 'destroy'])
    ->name('subjects.delete');

    Route::get('/chart-get', [ChartController::class, 'chartGet'])
    ->name('chart-get');

});

require __DIR__.'/auth.php';
