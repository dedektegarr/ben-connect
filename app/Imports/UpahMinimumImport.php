<?php

namespace App\Imports;

use App\Models\Region;
use App\Models\UpahMinimum;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UpahMinimumImport implements ToCollection, WithStartRow
{
    private $regions;

    public function __construct()
    {
        $this->regions = Region::pluck("region_name", "region_id")->toArray();
    }

    public function startRow(): int
    {
        return 3;
    }

    public function collection(Collection $collection)
    {
        // Mengambil tahun yang tersedia pada header
        $yearInHeader = $collection[0]->filter(function ($row) {
            return preg_match('/^\d{4}$/', trim($row));
        });

        foreach ($collection as $row) {
            $regionId = $this->findRegionId($row[1]);

            if (!$regionId) continue;

            foreach ($yearInHeader as $yearIndex => $year) {
                UpahMinimum::updateOrCreate([
                    "region_id" => $regionId,
                    "year" => $year,
                    "salary" => $row[$yearIndex]
                ]);
            }
        }
    }

    private function findRegionId($region)
    {
        $region = strtolower($region);
        if ($region != "kota bengkulu" && $region != "bengkulu" && $region != "provinsi bengkulu") {
            $region = "kabupaten" . " " . $region;
        }

        $regions = array_map("strtolower", $this->regions);
        return array_search($region, $regions);
    }
}
