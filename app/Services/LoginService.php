<?php

namespace App\Services;

use App\Exceptions\AppError;
use Illuminate\Support\Facades\Log;

class LoginService {
  public function execute($data){
    Log::debug("Service Login");

    if (!$token = auth()->attempt($data)) {
      throw new AppError('Unauthorized', 401);
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
