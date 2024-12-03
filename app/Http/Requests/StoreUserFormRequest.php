<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserFormRequest extends FormRequest
{
    use ApiResponse;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'El rol es requerido',
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser válido',
            'password.required' => 'La contraseña es requerida'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->badRequest($validator->errors()));
    }
}
