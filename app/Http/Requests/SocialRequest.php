<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class SocialRequest extends FormRequest
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
        // Aturan validasi untuk metode store (POST) dan update (PUT/PATCH)
        $rules = [
            'area_id' => 'required|uuid|exists:area,area_id',
            'have' => 'nullable|numeric',
            'dataset_id' => 'nullable|uuid|exists:dataset,dataset_id',
            'social_category_id' => 'required|uuid|exists:social_category,social_category_id',
            'nothing' => 'nullable|numeric',
            'date_notice' => 'nullable|date',
            'count' => 'nullable|numeric',
        ];

        // Untuk metode update
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Contoh: Pada update, area_id bisa opsional
            $rules['area_id'] = 'sometimes|uuid|exists:area,area_id';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'area_id.required' => 'Area ID wajib diisi.',
            'area_id.uuid' => 'Area ID harus berupa UUID yang valid.',
            'area_id.exists' => 'Area ID tidak ditemukan dalam database.',
            'have.numeric' => 'Kolom ada harus berupa angka.',
            'dataset_id.uuid' => 'Year ID harus berupa UUID yang valid.',
            'dataset_id.exists' => 'Year ID tidak ditemukan dalam database.',
            'social_category_id.required' => 'Kategori sosial ID wajib diisi.',
            'social_category_id.uuid' => 'Kategori sosial ID harus berupa UUID yang valid.',
            'social_category_id.exists' => 'Kategori sosial ID tidak ditemukan dalam database.',
            'nothing.numeric' => 'Kolom tidak ada harus berupa angka.',
            'date_notice.date' => 'Kolom tanggal terbit harus berisi tanggal yang valid.',
            'count.numeric' => 'Kolom jumlah harus berupa angka.',
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
