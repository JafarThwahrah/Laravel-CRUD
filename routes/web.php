<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomAuthController;


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
Route::put('/books/{id}/update', [BookController::class, 'update'])->name('Bookupdate');


//add new book form and save
Route::get('/books/addBook', [BookController::class, 'create'])->name('addBook');
Route::post('/books/addBook', [BookController::class, 'store'])->name('saveBook');



//View Book details
Route::get('/books/{id}', [BookController::class, 'show'])->name('Book.Details');


//Author information
Route::get('/books/del/authorinfo/{name}', [BookController::class, 'author_details'])->name('authorinfo');


//Delete Book record
Route::delete('/books/{id}/delete', [BookController::class, 'destroy'])->name('Book.destroy');

//sort books
Route::post('/books/sort', [BookController::class, 'sort'])->name('sortbooks');

//trash page 
Route::get('/books/del/trash', [BookController::class, 'trash'])->name('trash');

//force delete  
Route::delete('/books/del/trash/Forcedelete/{id}', [BookController::class, 'Forcedelete'])->name('Forcedelete');

//restore softdeleted items
Route::get('/books/del/trash/restore/{id}', [BookController::class, 'restore'])->name('restore');





Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->middleware('can:admin');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('user', [CustomAuthController::class, 'userpage'])->name('user'); 



