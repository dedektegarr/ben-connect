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
            'school_npsn'=>'required|integer|unique:school,school_npsn',
            'school_name'=>'required|max:100',
            'school_status'=>'required|in:negeri,swasta',
            'school_level_id'=>'required|exists:school_level,school_level_id',
            'area_id'=>'required|exists:area,area_id',
            'school_address'=>'required|min:5',
            'latitude'=>'required',
            'longitude'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'school_npsn.required'=>'NPSN sekolah tidak boleh kosong',
            'school_npsn.integer'=>'NPSN sekolah harus berupa angka',
            'school_npsn.unique' => 'NPSN sekolah sudah digunakan!',
            'school_name.required'=>'Nama sekolah tidak boleh kosong',
            'school_name.max'=>'Nama sekolah maksimal 100 karakter',
            'school_status.required'=>'Status Sekolah tidak boleh kosong',
            'school_status.in'=>'Status Sekolah hanya bisa berupa negeri atau swasta',
            'school_level_id.required'=>'Jenjang sekolah tidak boleh kosong',
            'school_level_id.exists'=>'Jenjang sekolah tidak ditemukan',
            'area_id.required'=>'Nama daerah tidak boleh kosong',
            'area_id.exists'=>'Nama daerah tidak ditemukan',
            'school_address.required'=>'Alamat sekolah tidak boleh kosong',
            'school_address.min'=>'Alamat sekolah minimal 5 karakter',
            'latitude.required'=>'Garis latitude tidak boleh kosong',
            'longitude.required'=>'Garis longitude tidak boleh kosong',
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
