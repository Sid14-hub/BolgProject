<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomController;

// To welcome page
Route::get('/', [WelcomController::class, 'index'])->name('welcom.index');

//to blog page
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

//to single blog page
Route::get('/blog/post', [BlogController::class, 'show'])->name('blog.show');

//to about
Route::get('/about', function () {
    return view('about');
})->name('about');

//to contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
