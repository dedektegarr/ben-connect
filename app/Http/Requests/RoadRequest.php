<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RoadRequest extends FormRequest
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
            'dataset_id' => 'required',
            'area_id' => 'required',
            'road_category_id' => 'required',
            'road_long' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'dataset_id.required' => 'Tahun data tidak boleh kosong',
            'area_id.required' => 'Daerah tidak boleh kosong',
            'road_category_id.required' => 'Kategori jalan tidak boleh kosong',
            'long.required' => 'Panjang jalan tidak boleh kosong',
            'long.numeric' => 'Panjang jalan harus angka'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
    
}
