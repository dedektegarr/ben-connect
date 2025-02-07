<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OPDKesehatanRequest extends FormRequest
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
        $rules= [
            'category_hospital_input'=> [
                'category_hospital_name' => 'required|max:100|unique:category_hospital,category_hospital_name'
            ],
            'hospital_acreditation_input'=> [
                'hospital_acreditation_name' => 'required|max:100|unique:hospital_acreditation_,hospital_acreditation_name'
            ],
            'hospital_ownership_input'=> [
                'hospital_ownership_name' => 'required|max:100|unique:hospital_ownership,hospital_ownership_name'
            ],
            'hospital_data_input'=> [
                'hospital_data_name' => 'required|max:100|unique:hospital_data,hospital_data_name',
                'hospital_data_nib' => 'required|max:100|unique:hospital_data,hospital_data_nib',
                'category_hospital_id' =>'required|exists:category_hospital,category_hospital_id',
                'hospital_acreditation_id' =>'required|exists:hospital_acreditation,hospital_acreditation_id',
                'hospital_data_class' =>'required|in:A,B,C,D,-',
                'region_id'=>'required|exists:region,region_id',
                'hospital_ownership_id'=>'required|exists:hospital_ownership,hospital_ownership_id',
                'hospital_data_email' => 'required|email',
                'hospital_data_telp'=>['required','regex:/^(\+62|62|0)[0-9]{9,13}$/','unique:hospital_data,hospital_data_telp'],
                'hospital_data_longitude'=>['required', 'regex:/^[-]?([1-8]?[0-9](\.\d+)?|90(\.0+)?)$/'],
                'hospital_data_latitude'=>['required', 'regex:/^[-]?([1-8]?[0-9](\.\d+)?|90(\.0+)?)$/'],
            ],
        ];

        return $rules[$this->type];
    }

    public function messages(): array
    {
        $messages = [
            'category_hospital_input' => [
                'category_hospital_name.required' => 'Nama kategori rumah sakit wajib diisi.',
                'category_hospital_name.max' => 'Nama kategori rumah sakit maksimal 100 karakter.',
                'category_hospital_name.unique' => 'Nama kategori rumah sakit sudah terdaftar.',
            ],
            'hospital_acreditation_input' => [
                'hospital_acreditation_name.required' => 'Nama akreditasi rumah sakit wajib diisi.',
                'hospital_acreditation_name.max' => 'Nama akreditasi rumah sakit maksimal 100 karakter.',
                'hospital_acreditation_name.unique' => 'Nama akreditasi rumah sakit sudah terdaftar.',
            ],
            'hospital_ownership_input' => [
                'hospital_ownership_name.required' => 'Nama kepemilikan rumah sakit wajib diisi.',
                'hospital_ownership_name.max' => 'Nama kepemilikan rumah sakit maksimal 100 karakter.',
                'hospital_ownership_name.unique' => 'Nama kepemilikan rumah sakit sudah terdaftar.',
            ],
            'hospital_data_input' => [
                'hospital_data_name.required' => 'Nama rumah sakit wajib diisi.',
                'hospital_data_name.max' => 'Nama rumah sakit maksimal 100 karakter.',
                'hospital_data_name.unique' => 'Nama rumah sakit sudah terdaftar.',

                'hospital_data_nib.required' => 'Nomor Induk Berusaha (NIB) rumah sakit wajib diisi.',
                'hospital_data_nib.max' => 'NIB rumah sakit maksimal 100 karakter.',
                'hospital_data_nib.unique' => 'NIB rumah sakit sudah terdaftar.',

                'category_hospital_id.required' => 'Kategori rumah sakit wajib diisi.',
                'category_hospital_id.exists' => 'Kategori rumah sakit tidak ditemukan.',

                'hospital_acreditation_id.required' => 'Akreditasi rumah sakit wajib diisi.',
                'hospital_acreditation_id.exists' => 'Akreditasi rumah sakit tidak ditemukan.',

                'hospital_data_class.required' => 'Kelas rumah sakit wajib diisi.',
                'hospital_data_class.in' => 'Kelas rumah sakit harus salah satu dari: A, B, C, D, -.',

                'region_id.required' => 'ID wilayah wajib diisi.',
                'region_id.exists' => 'ID wilayah tidak ditemukan.',

                'hospital_ownership_id.required' => 'ID kepemilikan rumah sakit wajib diisi.',
                'hospital_ownership_id.exists' => 'ID kepemilikan rumah sakit tidak ditemukan.',

                'hospital_data_email.required' => 'Email rumah sakit wajib diisi.',
                'hospital_data_email.email' => 'Format email rumah sakit tidak valid.',

                'hospital_data_telp.required' => 'Nomor telepon rumah sakit wajib diisi.',
                'hospital_data_telp.regex' => 'Format nomor telepon harus valid (contoh: +6281234567890 atau 081234567890).',
                'hospital_data_telp.unique' => 'Nomor telepon rumah sakit sudah terdaftar.',

                'hospital_data_longitude.required' => 'Longitude rumah sakit wajib diisi.',
                'hospital_data_longitude.regex' => 'Format longitude tidak valid. Harus berada di antara -180 hingga 180.',

                'hospital_data_latitude.required' => 'Latitude rumah sakit wajib diisi.',
                'hospital_data_latitude.regex' => 'Format latitude tidak valid. Harus berada di antara -90 hingga 90.',
            ],
        ];

        return $messages[$this->type];
    }
}
