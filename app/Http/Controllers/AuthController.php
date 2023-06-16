<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller {
  // public function __construct() {
  //   $this->middleware('auth:api', ['except' => ['login', 'register']]);
  // }

  public function login(LoginRequest $request){
    Log::debug("Requisição Login");

    if (!$token = auth()->attempt($request->validated())) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->createNewToken($token);
  }

  protected function createNewToken($token){
    return response()->json([
      'access_token' => $token,
      'user' => auth()->user()
    ]);
}
}
