<?php

namespace App\Imports;

use App\Models\Region;
use App\Models\Irrigation;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class IrrigationImport implements ToCollection, WithStartRow
{
    private $regions;

    public function __construct()
    {
        $this->regions = Region::pluck("region_name", "region_id")->toArray();
    }

    public function startRow(): int
    {
        return 7;
    }

    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $index => $row) {
            if ($row[0] === null || $row[1] === null) {
                continue;
            }

            $regionName = isset($rows[$index + 1]) ? $rows[$index + 1][1] : null;
            $formattedRegionName = $this->regionFormat($regionName);

            $regionId = array_search(strtolower($formattedRegionName), array_map('strtolower', $this->regions));

            $data[] = [
                "region_id" => $regionId,
                "daerah" => $row[1],
                "luas_potensial" => $row[3] ?? 0,
                "luas_fungsional" => $row[4] ?? 0,
                "panjang_saluran" => $row[5] ?? 0,
                "keterangan" => $row[6] ?? null,
            ];

            foreach ($data as $irrigation) {
                Irrigation::updateOrCreate($irrigation);
            }
        }
    }

    // function to convert Kab. to Kabupaten and Kota to Kota
    private function regionFormat($region)
    {
        $region = strtolower($region);
        $region = str_replace("kab.", "kabupaten", $region);
        $region = str_replace("kota", "kota", $region);

        return $region;
    }
}
