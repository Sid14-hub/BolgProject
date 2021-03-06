<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomController;

// To welcome page
Route::get('/', [WelcomController::class, 'index'])->name('welcom.index');

//to blog page
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

//to create blog post
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');

//to single blog page
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

//To edit single blog post
Route::get('/blog/{post}/edit', [BlogController::class, 'edit'])->name('blog.edit');

//To update single blog post
Route::put('/blog/{post}', [BlogController::class, 'update'])->name('blog.update');

//To delete single blog post
Route::delete('/blog/{post}', [BlogController::class, 'destroy'])->name('blog.destroy');

//to store blog post to the database
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');

//to about
Route::get('/about', function () {
    return view('about');
})->name('about');

//to contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
