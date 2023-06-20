<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Services\CreateDepositService;
use App\Services\CreateUserService;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {
    public function createUser(UserPostRequest $request) {
      // Log::debug("Requisição Create:USER", $request->all());

      $createUserService = new CreateUserService();

      return $createUserService->execute($request->all());
    }

    public function deposit(DepositRequest $request) {
      $createDepositService = new CreateDepositService();

      return $createDepositService->execute(auth()->user()->id, $request->value);
    }
}
