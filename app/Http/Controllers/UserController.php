<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {
    public function createUser(UserPostRequest $request) {
      Log::debug("Requisição Create:USER", $request->all());
      $user = User::create($request->all());

      return response()->json([$user]);
    }
}
