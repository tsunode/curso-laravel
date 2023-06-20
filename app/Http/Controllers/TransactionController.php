<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionPostRequest;
use App\Services\NewTransactionService;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller {
  public function store(TransactionPostRequest $request){
    Log::debug("Requisição Transação", $request->all());
    $transactionService = new NewTransactionService();

    return $transactionService->execute($request->validated());
  }
}
