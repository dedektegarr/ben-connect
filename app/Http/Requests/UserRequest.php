<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $type;

    public function __construct($type = null)
    {
        parent::__construct();
        $this->type = $type;
    }
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
        $rules = [
            'user_input' => [
                'name' => 'required|max:50',
                'email' => 'required|email|min:8|max:50',
                'password' => 'required|min:8',
                'role' => 'required'
            ],
            'user_update' => [
                'name' => 'required|max:50',
                'email' => 'required|email|min:8|max:50',
                'role' => 'required'
            ],
            'user_login' => [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ],
            'user_update_password' => [
                'current_password' => 'required|min:8',
                'new_password' => 'required|min:8|confirmed',
                'new_password_confirmation' => 'required|min:8'
            ]
        ];
        
        return $rules[$this->type];
    }

    public function messages(): array
    {
        $messages = [
            'user_input' => [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama maksimal 50 karakter',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.min' => 'Email minimal 8 karakter',
                'email.max' => 'Email maksimal 50 karakter',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
                'role' => 'Role tidak boleh kosong'
            ],
            'user_update' => [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama maksimal 50 karakter',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.min' => 'Email minimal 8 karakter',
                'email.max' => 'Email maksimal 50 karakter',
                'role' => 'Role tidak boleh kosong'
            ],
            'user_login' => [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter'
            ],
            'user_update_password' => [
                'current_password.required' => 'Password saat ini tidak boleh kosong',
                'current_password.min' => 'Password saat ini tidak valid',
                'new_password.required' => 'Password baru tidak boleh kosong',
                'new_password.min' => 'Password baru tidak valid',
                'new_password.confirmed' => 'Konfirmasi password tidak sama dengan password baru',
                'new_password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
                'new_password_confirmation.min' => 'Konfirmasi password tidak valid'
            ]
        ];
        return $messages[$this->type];
    }
}
