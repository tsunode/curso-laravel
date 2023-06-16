<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest {

  public function authorize(): bool {
    return true;
  }

  public function rules(): array {
    return [
      'name' => 'required',
      'cpf' => 'required',
      'email' => ['required', 'email'],
      'password' => ['required','min:7']
    ];
  }

  public function messages(): array{
    return [
      'name.required' => 'O nome é obrigatório',
      'cpf.required' => 'O cpf é obrigatório',
      'email.required' => 'O envio do e-mail é obrigatório',
      'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido',
      'password.required' => 'A senha é obrigatória',
      'password.min' => 'A senha deve conter no mínimo 7 caracteres',
    ];
  }
}
