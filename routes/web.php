<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Middleware\IsValidToken;

Route::get('/', function () {
    return view('welcome');
});

// Post Routes
Route::post('/shorten', [UrlController::class, 'shorten'])->middleware(IsValidToken::class);

// Redirect Roures
Route::get('/{hash}', [UrlController::class, 'redirect']);
Route::get('/{any}/{hash}', [UrlController::class, 'redirectFolder']);




