<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Region;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Models\PencariKerjaTerdaftar;
use App\Models\PenempatanTenagaKerja;
use App\Models\LowonganKerjaTerdaftar;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KetenagakerjaanImport implements ToCollection, WithStartRow
{
    private $year;
    private $regions;

    public function __construct($year)
    {
        $this->year = $year;
        $this->regions = Region::pluck("region_name", "region_id")->toArray();
    }

    public function startRow(): int
    {
        return 6;
    }

    public function collection(Collection $collection)
    {
        $pencariKerjaTerdaftar = $collection->map(function ($row) {
            return [
                'region_id' => $this->findRegionId($row[0]),
                'male' => (int) $row[1],
                'female' => (int) $row[2],
                'year' => $this->year,
            ];
        })->filter(fn($row) => $row["region_id"])->toArray();

        $lowonganKerjaTerdaftar = $collection->map(function ($row) {
            return [
                'region_id' => $this->findRegionId($row[0]),
                'male' => is_numeric($row[4]) ? (int) $row[4] : 0,
                'female' => is_numeric($row[5]) ? (int) $row[5] : 0,
                'year' => $this->year,
            ];
        })->filter(fn($row) => $row["region_id"])->toArray();

        $penempatanTenagaKerja = $collection->map(function ($row) {
            return [
                'region_id' => $this->findRegionId($row[0]),
                'male' => (int) $row[7],
                'female' => (int) $row[8],
                'year' => $this->year,
            ];
        })->filter(fn($row) => $row["region_id"])->toArray();

        foreach ($pencariKerjaTerdaftar as $data) {
            PencariKerjaTerdaftar::updateOrCreate($data);
        }
        foreach ($lowonganKerjaTerdaftar as $data) {
            LowonganKerjaTerdaftar::updateOrCreate($data);
        }
        foreach ($penempatanTenagaKerja as $data) {
            PenempatanTenagaKerja::updateOrCreate($data);
        }
    }

    // function to add Kabupaten and Kota to Kota
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
