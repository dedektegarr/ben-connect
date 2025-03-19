<?php

namespace App\Http\Requests\study;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TeacherRequest extends FormRequest
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
            'teacher_file' => 'required|file|mimes:xls,xlsx|max:5000',
            'year' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'teacher_file.required' => 'File data jumlah guru tidak boleh kosong',
            'teacher_file.file' => 'Data jumlah guru harus berupa file',
            'teacher_file.mimes' => 'File data jumlah guru harus berformat .xls atau .xlsx',
            'teacher_file.max' => 'File data jumlah guru maksimal 5 Mb ',
            'year.required' => 'Tahun tidak boleh kosong',
            'year.numeric' => 'Tahun harus berupa angka'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => 'Data guru gagal di validasi',
            'errors' => $validator->errors(),
        ], 422));
    }
}
