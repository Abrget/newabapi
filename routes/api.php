<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// Example GET API Route
Route::get('/users', function () {
    return response()->json(['message' => 'API is working!']);
});
Route::post('status',[ApiController::class,'status']);
Route::post('sbalance',[ApiController::class,'sbalance']);
Route::post('fbalance',[ApiController::class,'fbalance']);
Route::post('withdraw',[ApiController::class,'withdraw']);
Route::post('transfer',[ApiController::class,'transfer']);