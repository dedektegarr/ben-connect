<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public $validator = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Password saat ini tidak boleh kosong',
            'current_password.min' => 'Password saat ini tidak valid',
            'new_password.required' => 'Password baru tidak boleh kosong',
            'new_password.min' => 'Password baru tidak valid',
            'new_password.confirmed' => 'Konfirmasi password tidak sama dengan password baru',
            'new_password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'new_password_confirmation.min' => 'Konfirmasi password tidak valid',
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
