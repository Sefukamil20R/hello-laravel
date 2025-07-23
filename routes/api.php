<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::middleware(['auth:sanctum'])->get('/me', function (Request $request) {
//     return response()->json($request->user());
// });
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('me', [AuthController::class, 'me']);