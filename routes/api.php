<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BooksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(RegisterController::class)->group(function() {
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/books/create', [BooksController::class, 'create']);
    Route::get('/books', [BooksController::class, 'get']);
    Route::post('/books/update/{book}', [BooksController::class, 'update']);
    Route::delete('/books/delete/{book}', [BooksController::class, 'delete']);
    Route::get('/books/get/{book}', [BooksController::class, 'getSingular']);
});
