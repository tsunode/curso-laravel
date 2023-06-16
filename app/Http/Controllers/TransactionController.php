<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionPostRequest;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller {
  public function store(TransactionPostRequest $request){
    Log::debug("Requisição Login", $request->all());

    return 2;
  }
  public function opa(TransactionPostRequest $request){
    Log::debug("Requisição Login", $request->all());

    return 3;
  }
}
