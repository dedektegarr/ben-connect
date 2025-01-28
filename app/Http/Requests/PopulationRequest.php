<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PopulationRequest extends FormRequest
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
            'period_input' => [
                'population_period_semester' => 'required|in:1,2',
                'population_period_year' => 'required|digits:4'
            ],
            'age_group_input' => [
                'population_age_group_years' => 'required'
            ]
        ];
        return $rules[$this->type];
    }

    public function messages(): array
    {
        $messages = [
            'period_input' => [
                'population_period_semester.required' => 'Semester tidak boleh kosong',
                'population_period_semester.in' => 'Semester harus diisi 1 atau 2',
                'population_period_year.required' => 'Tahun tidak boleh kosong',
                'population_period_year.digit' => 'Tahun harus 4 digit'
            ],
            'age_group_input' => [
                'population_age_group_years.required' => 'Kelompok umur tidak boleh kosong' 
            ]
        ];
        return $messages[$this->type];
    }
}
