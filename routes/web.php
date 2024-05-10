<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// routes/web.php
Route::get('/books',[  App\Http\Controllers\BookController::class, 'index']);
Route::post('/books', [  App\Http\Controllers\BookController::class, 'store']);
Route::get('/books/{id}', [ App\Http\Controllers\BookController::class, 'show']); 

// Authentication Routes
Route::post('/register',[  App\Http\Controllers\UserController::class, 'register']);  
Route::post('/login', [  App\Http\Controllers\UserController::class, 'login']); 
Route::post('/logout',[  App\Http\Controllers\UserController::class, 'logout']); 
// Member Routes
Route::middleware('auth')->group(function () {
    Route::post('/books/{book}/favorite',[ App\Http\Controllers\MemberController::class, 'addToFavorites']);
    Route::delete('/books/{book}/favorite',[  App\Http\Controllers\MemberController::class, 'removeFromFavorites']);  
    Route::post('/books/{book}/review',[  App\Http\Controllers\ReviewController::class, 'addReview']); 
});
// Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::post('/categories', [  App\Http\Controllers\AdminController::class, 'createCategory']); 
    Route::delete('/categories/{category}', [ App\Http\Controllers\AdminController::class, 'deleteCategory']); 
    Route::post('/books',[  App\Http\Controllers\AdminController::class, 'addBook']); 
    Route::put('/books/{book}', [  App\Http\Controllers\AdminController::class, 'updateBook']); 
    Route::delete('/books/{book}', [  App\Http\Controllers\AdminController::class, 'deleteBook']);
});

// Visitor Routes
Route::get('/books',  [  App\Http\Controllers\VisitorController::class, 'browseBooks']);
Route::get('/categories/{category_id}/books', [ App\Http\Controllers\VisitorController::class, 'filterBooksByCategory']); 
