<?php

namespace App\Http\Requests\study;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SchoolRequest extends FormRequest
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
            'school_file' => 'required|file|mimes:xls,xlsx|max:5000',
        ];
    }
    public function messages()
    {
        return [
            'school_file.required' => 'File data jumlah sekolah tidak boleh kosong',
            'school_file.file' => 'Data jumlah sekolah harus berupa file',
            'school_file.mimes' => 'File data jumlah sekolah harus berformat .xls atau .xlsx',
            'school_file.max' => 'File data jumlah sekolah maksimal 5 Mb ',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => 'Data Sekolah gagal di validasi',
            'errors' => $validator->errors(),
        ], 422));
    }
}
