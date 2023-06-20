<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller {
  public function login(LoginRequest $request){
    Log::debug("Requisição Login");

    $loginService = new LoginService();

    return $loginService->execute($request->validated());
  }
}
