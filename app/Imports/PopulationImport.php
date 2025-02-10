<?php

namespace App\Imports;

use App\Models\Population;
use App\Models\PopulationAgeGroup;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Collection;

HeadingRowFormatter::default('none');

class PopulationImport implements ToModel, WithHeadingRow
{
    private $populationPeriodId;
    private $ageRanges;
    private $regions;

    public function __construct($id)
    {
        $this->populationPeriodId = $id;
        $this->ageRanges = PopulationAgeGroup::pluck("population_age_group_years", "population_age_group_id")->toArray();
        $this->regions = Region::pluck("region_name", "region_id")->toArray();
    }

    public function model(array $row)
    {
        // Ambil semua data master yang dibutuhkan dari database
        $periodId = $this->populationPeriodId;
        $ageRanges = $this->ageRanges;
        $regions = array_map('strtolower', $this->regions);

        // Memastikan row dari excel tidak kosong
        if (empty($row) || !array_key_exists("WILAYAH", $row) || empty($row["WILAYAH"])) {
            return null;
        }

        // Menyesuakan format region dan mencari apakah ada region dari excel yang sesuai dengan region di db
        $regionInExcel = $this->regionFormat(trim($row["WILAYAH"]));
        $regionId = array_search(strtolower($regionInExcel), $regions);

        // Melakukan perulangan sebanyak jumlah data rentang usia
        foreach ($ageRanges as $ageRangeId => $range) {
            // Mengambil data berdasrkan rentang usia dan jenis kelamin
            $male = $row["$range(LK)"] ?? null;
            $female = $row["$range(PR)"] ?? null;

            // Skip jika data kosong
            if (empty($male) && empty($female)) {
                continue;
            }

            // Store ke database jika region sesuai
            if ($regionId !== false) {
                Population::create([
                    'population_period_id' => $periodId,
                    'region_id' => $regionId,
                    'population_age_group_id' => $ageRangeId,
                    'population_male' => $row["$range(LK)"],
                    'population_female' => $row["$range(PR)"],
                ]);
            }
        }
    }

    private function regionFormat($value)
    {
        $region = strtolower($value);

        // Mengubah format region sesuai dengan data master
        $containsCity = $region == "bengkulu" || $region == 'kota bengkulu';
        $containsMukoMuko = str_contains($region, "muko muko");

        if ($containsCity) {
            return $region;
        }

        if ($containsMukoMuko) {
            $region = str_replace($region, "muko muko", "muko-muko");
        }

        return "kabupaten " . $region;
    }
}
