<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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


//home page
Route::get('/', [BookController::class, 'index']);
Route::get('/books', [BookController::class, 'index'])->name('homePage');


//update book
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('Book.edit');
Route::post('/books/{id}/update', [BookController::class, 'update'])->name('Bookupdate');


//add new book form and save
Route::get('/books/addBook', [BookController::class, 'create'])->name('addBook');
Route::post('/books/addBook', [BookController::class, 'store'])->name('saveBook');



//View Book details
Route::get('/books/{id}', [BookController::class, 'show'])->name('Book.Details');

//Delete Book record
Route::get('/books/{id}/delete', [BookController::class, 'destroy'])->name('Book.destroy');
