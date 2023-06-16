<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionPostRequest extends FormRequest {

  public function authorize(): bool {
    return true;
  }

  public function rules(): array {
    return [
      'value' => ['required'],
      'payee' => ['required'],
      'payer' => ['required'],
    ];
  }
}
