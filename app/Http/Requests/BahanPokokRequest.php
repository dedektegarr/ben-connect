<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BahanPokokRequest extends FormRequest
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
            'bahan_pokok_name' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|integer|min:0',
            'waktu' => 'required|date',
            'pasar_id' => 'nullable|uuid|exists:pasar,pasar_id',
            'komoditi_id' => 'nullable|uuid|exists:komoditi,komoditi_id',
        ];
    }

    public function messages()
    {
        return [
            'bahan_pokok_name.required' => 'Nama bahan pokok wajib diisi.',
            'bahan_pokok_name.string' => 'Nama bahan pokok harus berupa teks.',
            'bahan_pokok_name.max' => 'Nama bahan pokok maksimal 255 karakter.',
            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan maksimal 50 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.integer' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga minimal adalah 0.',
            'waktu.required' => 'Waktu wajib diisi.',
            'waktu.date' => 'Waktu harus berupa format tanggal yang valid.',
            'pasar_id.uuid' => 'ID pasar harus berupa UUID yang valid.',
            'pasar_id.exists' => 'Pasar tidak ditemukan di database.',
            'komoditi_id.uuid' => 'ID komoditi harus berupa UUID yang valid.',
            'komoditi_id.exists' => 'Komoditi tidak ditemukan di database.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
}
