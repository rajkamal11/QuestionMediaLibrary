<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\LearningObjectiveController;
use App\Http\Controllers\UploadController;

// Home route (optional)
Route::get('/', function () {
    return view('layout');
});

// Question routes
Route::resource('question', QuestionController::class);

// Media routes
Route::resource('media', MediaController::class);
Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::get('/media/create', [MediaController::class, 'create'])->name('media.create');
Route::post('/media', [MediaController::class, 'store'])->name('media.store');
Route::get('/media/{id}', [MediaController::class, 'show'])->name('media.show');
Route::put('/media/{id}', [MediaController::class, 'update'])->name('media.update');

// Learning Objective routes
Route::resource('learningObjectives', LearningObjectiveController::class);

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [UploadController::class, 'upload'])->name('upload');