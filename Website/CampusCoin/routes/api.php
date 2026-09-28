<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookmarkController;

Route::middleware('auth')->group(function () {

    Route::get('/bookmarks', [BookmarkController::class, 'index']);

    Route::post('/bookmarks', [BookmarkController::class, 'store']);

    Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy']);

});