<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/top-authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/rate', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/rate', [RatingController::class, 'store'])->name('ratings.store');

// API AJAX untuk load buku
Route::get('/api/books-by-author/{authorId}', [RatingController::class, 'getBooksByAuthor']);
