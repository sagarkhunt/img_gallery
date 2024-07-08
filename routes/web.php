<?php

use App\Http\Controllers\ImageController;
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

// Home page route, accessible without authentication
Route::get('/', [ImageController::class, 'index'])->name('home');

// Gallery view route, accessible without authentication
Route::get('/gallery', [ImageController::class, 'showGallery'])->name('image.gallery');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/images/create', [ImageController::class, 'create']);
    Route::post('/images', [ImageController::class, 'store']);
    Route::get('/images/{id}/edit', [ImageController::class, 'edit']);
    Route::put('/images/{id}', [ImageController::class, 'update']);
    Route::delete('/images/{id}', [ImageController::class, 'destroy']);

    Route::get('/upload', [ImageController::class, 'showUploadForm'])->name('image.upload.form');
    Route::post('/upload', [ImageController::class, 'upload'])->name('image.upload');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
