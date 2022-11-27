<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
        Route::get('/comments', [CommentController::class, 'index']);
        Route::get('/comments/{comment}', [CommentController::class, 'show']);
        Route::post('/comments', [CommentController::class, 'store']);
        Route::patch('/comments/{comment}', [CommentController::class, 'update']);
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
    });

