<?php

use App\Http\Controllers\{AuthController, TransactionController, UserController};
use Illuminate\Support\Facades\Route;



Route::get('/test', function () {
  return response(2);
});

Route::post('/users' , [UserController::class, 'createUser']);

Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'
], function () {
  Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('jwt.verify')->group(function() {
  Route::post('/transactions' , [TransactionController::class, 'store']);
  Route::post('/users/{id}/deposits' , [UserController::class, 'deposit']);
});
