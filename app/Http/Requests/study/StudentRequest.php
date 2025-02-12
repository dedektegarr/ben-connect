<?php

namespace App\Http\Requests\study;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentRequest extends FormRequest
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
            'student_file' => 'required|file|mimes:xls,xlsx|max:5000',
        ];
    }
    public function messages()
    {
        return [
            'student_file.required' => 'File data jumlah peserta didik tidak boleh kosong',
            'student_file.file' => 'Data jumlah peserta didik harus berupa file',
            'student_file.mimes' => 'File data jumlah peserta didik harus berformat .xls atau .xlsx',
            'student_file.max' => 'File data jumlah peserta didik maksimal 5 Mb ',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => 'Data peserta didik gagal di validasi',
            'errors' => $validator->errors(),
        ], 422));
    }
}
