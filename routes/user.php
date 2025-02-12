<?php

use Illuminate\Support\Facades\Route;

// Example route
Route::get('/profile', function () {
    return response()->json(['message' => 'User Profile']);
});