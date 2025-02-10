<?php

namespace App\Http\Requests;

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
            'population_period_input' => [
                'population_period_semester' => 'required|in:1,2',
                'population_period_year' => 'required|digits:4'
            ],
            'population_age_group_input' => [
                'population_age_group_years' => 'required|unique:App\Models\PopulationAgeGroup,population_age_group_years'
            ],
            'population_input' => [
                'population_file' => 'required|file|mimes:xls,xlsx|max:5000',
                'population_period_id' => 'required'
            ],
        ];
        return $rules[$this->type];
    }

    public function messages(): array
    {
        $messages = [
            'population_period_input' => [
                'population_period_semester.required' => 'Semester tidak boleh kosong',
                'population_period_semester.in' => 'Semester harus diisi 1 atau 2',
                'population_period_year.required' => 'Tahun tidak boleh kosong',
                'population_period_year.digits' => 'Tahun harus 4 digit'
            ],
            'population_age_group_input' => [
                'population_age_group_years.required' => 'Kelompok umur tidak boleh kosong',
                'population_age_group_years.unique' => 'Kelompok umur sudah ada'
            ],
            'population_input' => [
                'population_file.required' => 'File data kependudukan tidak boleh kosong',
                'population_file.file' => 'Data kependudukan harus berupa file',
                'population_file.mimes' => 'File data kependudukan harus berformat .xls atau .xlsx',
                'population_file.max' => 'File data kependudukan maksimal 5 Mb ',
                'population_period_id.required' => 'Periode kependudukan tidak boleh kosong'
            ]
        ];
        return $messages[$this->type];
    }
}
