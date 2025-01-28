<?php

namespace App\Http\Requests\study;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SchoolFilter extends FormRequest
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
            "school_id"=>"required|exists:school,school_id",
            "dataset_id"=>"required|exists:dataset,dataset_id",
            "school_filter_total_teacher"=>'required|integer',
            "school_filter_total_student"=>'required|integer'
        ];
    }

    public function messages()
    {
        return [
            "school_id.required" => "Nama sekolah wajib diisi.",
            "school_id.exists" => "Nama sekolah tersebut tidak ditemukan dalam data.",
            "dataset_id.required" => "Tahun wajib diisi.",
            "dataset_id.exists" => "Tahun tersebut tidak ditemukan dalam data.",
            "school_filter_total_teacher.required" => "Jumlah guru wajib diisi.",
            "school_filter_total_teacher.integer" => "Jumlah guru harus berupa angka.",
            "school_filter_total_student.required" => "Jumlah siswa wajib diisi.",
            "school_filter_total_student.integer" => "Jumlah siswa harus berupa angka.",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => 'Data Sekolah gagal di validasi',
            'errors' => $validator->errors(),
        ],422));
    }
}
