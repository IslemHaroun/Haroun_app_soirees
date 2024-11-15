<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartyController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::post('login', [AuthController::class, 'login']);
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('add_users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

// creation de compte & authentification
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('parties', [PartyController::class, 'store']); 
    Route::get('parties', [PartyController::class, 'index']);
    Route::get('parties/{id}', [PartyController::class, 'show']);
    Route::delete('parties/{id}', [PartyController::class, 'destroy']);
    Route::put('parties_update/{id}', [PartyController::class, 'update']);
});

//  Route::get('/test', function () {
//      return response()->json([
//          'name' => 'islem',
//          'age' => '30'
//      ]);
//  });