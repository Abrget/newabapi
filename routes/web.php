<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/status', function () {
    $title = "Status";
    return view('status', compact('title'));
});
Route::get('/spot', function () {
    $title = "Spot Balance";
    return view('spot', compact('title'));
});
Route::get('/funding', function () {
    $title  = "Funding Balance";
    return view('funding', compact('title'));
});
Route::get('/withdraw', function () {
    $title  = "Withdraw Balance";
    return view('withdraw', compact('title'));
});


Route::post('status', [UserController::class, 'status'])->name('status');
Route::post('spot', [UserController::class, 'spot'])->name('spot');
Route::post('funding', [UserController::class, 'funding'])->name('funding');
Route::post('withdraw', [UserController::class, 'withdraw'])->name('withdraw');



Route::post('/profile', function () {
    return view('profile'); // Loads profile.blade.php
})->name('profile');

