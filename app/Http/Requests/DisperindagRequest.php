<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisperindagRequest extends FormRequest
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
            'variant' => [
                'variants_name' => 'required|string|max:255'
            ],
            'price' => [
                'prices_value' => 'required|numeric|min:0',
                'date' => 'required|date',
                'region_id' => 'required|uuid|exists:region,region_id',
                'variants_id' => 'required|uuid|exists:variants,variants_id'
            ]
        ];
        
        return $rules[$this->type];
    }

    public function messages(): array
    {
        $messages = [
            'variant' => [
                'variants_name.required' => 'Nama varian tidak boleh kosong.',
                'variants_name.string' => 'Nama varian harus berupa teks.',
                'variants_name.max' => 'Nama varian maksimal 255 karakter.'
            ],
            'price' => [
                'prices_value.required' => 'Harga tidak boleh kosong.',
                'prices_value.numeric' => 'Harga harus berupa angka.',
                'prices_value.min' => 'Harga tidak boleh negatif.',
                'date.required' => 'Tanggal tidak boleh kosong.',
                'date.date' => 'Format tanggal tidak valid.',
                'region_id.required' => 'Region ID tidak boleh kosong.',
                'region_id.uuid' => 'Format Region ID tidak valid.',
                'region_id.exists' => 'Region ID tidak ditemukan.',
                'variants_id.required' => 'Variant ID tidak boleh kosong.',
                'variants_id.uuid' => 'Format Variant ID tidak valid.',
                'variants_id.exists' => 'Variant ID tidak ditemukan.'
            ]
        ];
        return $messages[$this->type];
    }
}
