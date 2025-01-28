<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;


class RegionRequest extends FormRequest
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
            'region_input' => [
                'region_name' => 'required|max:100',
            ],
            'region_data_input' => [
                'region_id' => 'required|exists:App\Models\Region,region_id',
                'region_data_year' => 'required|digits:4',
                'region_data_area' => 'required|numeric',
                'region_data_polygon' => 'required|file|mimes:json|max:1000'
            ],
            'region_data_update' => [
                'region_data_year' => 'required|digits:4',
                'region_data_area' => 'required|numeric',
                'region_data_polygon' => 'nullable|file|mimes:json|max:1000'
            ],
            'region_data_show' => [
                'region_data_years' => 'nullable|digits:4'
            ]
        ];
        return $rules[$this->type];
    }

    public function messages(): array
    {
        $messages = [
            'region_input' => [
                'region_name.required' => 'Nama wilayah tidak boleh kosong',
                'region_name.max' => 'Nama wilayah terlalu panjang'
            ],
            'region_data_input' => [
                'region_id.required' => 'Id wilayah tidak boleh kosong',
                'region_id.exists' => 'Id wilayah tidak ditemukan',
                'region_data_year.required' => 'Tahun wilayah tidak boleh kosong',
                'region_data_year.digits' => 'Tahun wilayah tidak valid',
                'region_data_area.required' => 'Luas wilayah tidak boleh kosong',
                'region_data_area.numeric' => 'Luas wilayah harus angka dalam satuan Kilometer (Km)',
                'region_data_polygon.required' => 'Polygon wilayah tidak boleh kosong',
                'region_data_polygon.file' => 'Polygon wilayah harus berupa file',
                'region_data_polygon.mimes' => 'Polygon wilayah harus berformat json',
                'region_data_polygon.max' => 'Polygon wilayah maksimal 1 Mb'
            ],
            'region_data_update' => [
                'region_data_year.required' => 'Tahun wilayah tidak boleh kosong',
                'region_data_year.digits' => 'Tahun wilayah tidak valid',
                'region_data_area.required' => 'Luas wilayah tidak boleh kosong',
                'region_data_area.numeric' => 'Luas wilayah harus angka dalam satuan Kilometer (Km)',
                'region_data_polygon.file' => 'Polygon wilayah harus berupa file',
                'region_data_polygon.mimes' => 'Polygon wilayah harus berformat json',
                'region_data_polygon.max' => 'Polygon wilayah maksimal 1 Mb'
            ],
            'region_data_show' => [
                'region_data_years.digits' => 'Tahun data wilayah tidak valid'
            ]
        ];
        return $messages[$this->type];
    }

}
