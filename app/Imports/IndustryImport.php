<?php

namespace App\Imports;

use App\Models\Industry;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class IndustryImport implements ToCollection, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $regions;
    public $errors = [];
    private $batchSize = 1000;
    private $rowCount = 0;
    protected $year;

    public function __construct(int $year)
    {
        $this->regions = Region::select('region_id', 'region_name')->get();
        $this->year = $year;
    }

    public function collection($rows)
    {
        $rows->shift(); // skip header row kalau ada
        $insertData = [];

        foreach ($rows as $row) {
            $this->rowCount++;
            $rowNumber = $this->rowCount;

            $namaPerusahaan = $row[1] ?? null;
            $alamatKantorPusat = $row[2] ?? null;
            $provinsiKantor = $row[3] ?? null;
            $kabkotaKantor = $row[4] ?? null;
            $alamatPabrik = $row[5] ?? null;
            $provinsiPabrik = $row[6] ?? null;
            $kabkotaPabrik = $row[7] ?? null;
            $kbli = $row[8] ?? null;
            $bidangUsaha = $row[9] ?? null;
            $skalaUsaha = $row[10] ?? null;
            $terdaftarSiinas = $row[11] ?? null;

            if (empty($namaPerusahaan) && empty($kbli)) {
                continue;
            }

            if (empty(array_filter($row->toArray()))) {
                continue;
            }

            $normalizedRegion = strtolower(trim(str_replace(' ', '', $kabkotaPabrik)));
            $matchingRegion = $this->regions->first(function ($region) use ($normalizedRegion) {
                $regionNormalized = strtolower(str_replace([' ', '-'], '', $region->region_name));
                return $regionNormalized === $normalizedRegion;
            });

            if (!$matchingRegion) {
                $this->errors[] = "Baris $rowNumber: Kolom 'kab/kota' tidak tersedia atau kosong";
                continue;
            }

            $insertData[] = [
                'industry_ptname' => $namaPerusahaan,
                'industry_headoffice_address' => $alamatKantorPusat,
                'industry_office_province' => $provinsiKantor,
                'industry_city_office' => $kabkotaKantor,
                'industry_factory_address' => $alamatPabrik,
                'industry_factory_province' => $provinsiPabrik,
                'region_id' => $matchingRegion->region_id,
                'industry_kd_kbli' => $kbli,
                'industry_business_fields' => $bidangUsaha,
                'industry_business_scale' => $skalaUsaha,
                'industry_registered_sinas' => $terdaftarSiinas,
                'year' => $this->year,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($insertData)) {
            Industry::insertOrIgnore($insertData);
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function batchSize(): int
    {
        return $this->batchSize;
    }

    public function chunkSize(): int
    {
        return $this->batchSize;
    }
}
