<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('website.home');
})->name('home');

Route::get('/courses', function () {
    return view('website.courses');
})->name('courses');

Route::get('/contact', function () {
    return view('website.contact');
})->name('contact');

Route::get('/admissions', function () {
    return view('website.admissions');
})->name('admissions');

Route::get('/gallery', function () {
    return view('website.gallery');
})->name('gallery');

Route::get('/vision', function () {
    return view('website.vision');
})->name('vision');

Route::get('/news', function () {
    return view('website.news.index');
})->name('news');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
