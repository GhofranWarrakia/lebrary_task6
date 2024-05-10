<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/books', [ApiController::class, 'getAllBooks']);
Route::get('/books/{id}', [ApiController::class, 'getBook']);
Route::get('/categories', [ApiController::class, 'getAllCategories']);
Route::get('/categories/{category_id}/books', [ApiController::class, 'getBooksByCategory']);
Route::post('/books', [ApiController::class, 'addBook']);
Route::put('/books/{id}', [ApiController::class, 'updateBook']);
Route::delete('/books/{id}', [ApiController::class, 'deleteBook']);