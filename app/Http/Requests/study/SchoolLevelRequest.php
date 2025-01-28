<?php

namespace App\Http\Requests\study;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SchoolLevelRequest extends FormRequest
{
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
            'school_level_name'=>'required|max:100|unique:school_level,school_level_name'
        ];
    }

    public function messages(): array
    {
        return [
            'school_level_name.required' => 'Nama Level Sekolah tidak boleh kosong',
            'school_level_name.max' => 'Nama Level Sekolah terlalu panjang',
            'school_level_name.unique' => 'Nama Level Sekolah sudah digunakan, silakan pilih nama lain'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => 'Data Tag gagal di validasi',
            'errors' => $validator->errors(),
        ],422));
    }
}
