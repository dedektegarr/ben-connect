<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TagsRequest extends FormRequest
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
            'tag_name' => 'required|max:100|unique:tags,tag_name'
        ];
    }

    public function messages(): array
    {
        return [
            'tag_name.required' => 'Nama tag tidak boleh kosong',
            'tag_name.max' => 'Nama tag terlalu panjang',
            'tag_name..unique' => 'Nama tag sudah digunakan, silakan pilih nama lain'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => 'Data Tag gagal di validasi',
            'errors' => $validator->errors(),
        ],422));
    }
}
