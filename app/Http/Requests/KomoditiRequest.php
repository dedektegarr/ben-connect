<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class KomoditiRequest extends FormRequest
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
            'komoditi_name' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'pasar_id' => 'nullable|uuid|exists:pasar,pasar_id',
        ];
    }

    public function messages()
    {
        return [
            'komoditi_name.required' => 'Nama komoditi wajib diisi.',
            'komoditi_name.string' => 'Nama komoditi harus berupa teks.',
            'komoditi_name.max' => 'Nama komoditi maksimal 255 karakter.',
            'color.required' => 'Warna wajib diisi.',
            'color.string' => 'Warna harus berupa teks.',
            'color.max' => 'Warna maksimal 50 karakter.',
            'pasar_id.uuid' => 'ID pasar harus berupa UUID yang valid.',
            'pasar_id.exists' => 'Pasar tidak ditemukan di database.',
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
