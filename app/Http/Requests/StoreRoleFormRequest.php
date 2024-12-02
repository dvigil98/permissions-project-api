<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRoleFormRequest extends FormRequest
{
    use ApiResponse;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->badRequest($validator->errors()));
    }
}
