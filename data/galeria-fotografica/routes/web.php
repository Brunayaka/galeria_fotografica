<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Ruta para el dashboard de imágenes
Route::middleware(['auth', 'verified'])->get('/dashboard', [ImageController::class, 'index'])->name('dashboard');
// Definir dashboard con controlador ImageController
Route::middleware(['auth', 'verified'])->get('/dashboard', [ImageController::class, 'index'])->name('images.index');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->get('/dashboard', [ImageController::class, 'index'])->name('dashboard');


// Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de imágenes protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/images/upload', [ImageController::class, 'create'])->name('images.create');
    Route::post('/images', [ImageController::class, 'store'])->name('images.store');
    Route::post('/images/{image}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth'])->group(function () {
    Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
});

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::middleware('auth')->post('/images/{image}/vote', [VoteController::class, 'store'])->name('images.vote');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');


require __DIR__.'/auth.php';
