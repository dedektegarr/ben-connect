<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasarRequest extends FormRequest
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
            'pasar_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area_id' => 'nullable|uuid|exists:area,area_id',
        ];
    }

    public function messages()
    {
        return [
            'pasar_name.required' => 'Nama pasar wajib diisi.',
            'pasar_name.string' => 'Nama pasar harus berupa teks.',
            'pasar_name.max' => 'Nama pasar maksimal 255 karakter.',
            'latitude.required' => 'Latitude wajib diisi.',
            'latitude.numeric' => 'Latitude harus berupa angka.',
            'longitude.required' => 'Longitude wajib diisi.',
            'longitude.numeric' => 'Longitude harus berupa angka.',
            'area_id.uuid' => 'ID area harus berupa UUID yang valid.',
            'area_id.exists' => 'Area tidak ditemukan di database.',
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
