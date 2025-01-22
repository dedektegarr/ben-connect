<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewsRequest extends FormRequest
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
            'news_title'=>'required|min:5',
            'news_image'=>[
                'image',
                'mimes:jpg,png,jpeg,gif,svg',
                'dimensions:min_width=100,min_height=100,max_width=1800,max_height=1800',
                'max:2048',
            ],
            'news_description'=>'required|min:10',
            'news_category'=>'required|in:pengumuman,berita',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,tag_id', 
        ];
    }

    public function messages()
    {
        return [
            'news_title.required' => 'Judul berita harus diisi.',
            'news_title.min' => 'Judul berita minimal 5 karakter.',
            'news_image.image' => 'Gambar harus berupa file gambar.',
            'news_image.mimes' => 'Gambar hanya boleh memiliki format: jpg, png, jpeg, gif, svg.',
            'news_image.dimensions' => 'Dimensi gambar harus antara 100x100 hingga 1800x1800 piksel.',
            'news_image.max' => 'Ukuran file gambar maksimal adalah 2MB.',
            'news_description.required' => 'Deskripsi berita harus diisi.',
            'news_description.min' => 'Deskripsi berita minimal 10 karakter.',
            'news_description.max' => 'Deskripsi berita maksimal 500 karakter.',
            'news_category.required' => 'Kategori berita harus dipilih.',
            'news_category.in' => 'Kategori berita hanya bisa berupa pengumuman atau berita.',

            // Pesan untuk tags
            'tags.array' => 'Tags harus berupa array.',
            'tags.*.exists' => 'Tag yang dipilih tidak valid atau tidak ada dalam sistem.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => 'Data Berita gagal di validasi',
            'errors' => $validator->errors(),
        ],422));
    }
}
