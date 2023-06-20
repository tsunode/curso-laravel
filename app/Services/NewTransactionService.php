<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Transaction;
use App\Models\User;

class NewTransactionService {
  public function execute(array $data){
    $userPayer = User::find($data['payer']);

    if(is_null($userPayer)) {
      throw new AppError('Payer not found', 404);
    }

    if($userPayer->type === 'SELLER') {
      throw new AppError('Invalid user type', 403);
    }

    $userPayee = User::find($data['payee']);

    if(is_null($userPayee)) {
      throw new AppError('Payer not found', 404);
    }

    if($userPayer->balance < $data['value']) {
      throw new AppError('Balance not sufficient', 400);
    }

    $userPayer->balance = $userPayer->balance - $data['value'];
    $userPayee->balance = $userPayer->balance + $data['value'];

    $userPayer->save();
    $userPayee->save();

    return Transaction::create([
      'payee_id' => $userPayee->id,
      'payer_id' => $userPayer->id,
      'value' => $data['value']
    ]);
  }
}
