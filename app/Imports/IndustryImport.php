<?php

namespace App\Imports;

use App\Models\Industry;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class IndustryImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
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

    public function __construct()
    {
        $this->regions = Region::select('region_id', 'region_name')->get();
    }

    public function model(array $row)
    {
        dd($row);
        // Cek apakah semua kolom penting kosong
        $isEmptyRow = empty($row['Nama Perusahaan']) &&
            empty($row['KBLI']);

        if ($isEmptyRow) {
            return null;
        }

        $this->rowCount++;
        $rowNumber = $this->rowCount;

        $kabKota = $row['Kabkota Pabrik'] ?? '';
        $normalizedRegion = strtolower(trim(str_replace(' ', '', $kabKota)));
        $matchingRegion = $this->regions->first(function ($region) use ($normalizedRegion) {
            return strtolower(str_replace(' ', '', $region->region_name)) === $normalizedRegion;
        });

        // Jika tidak ada kecocokan dengan region yang tersedia tampil pesan error
        if (!$matchingRegion) {
            $this->errors[] = "Baris $rowNumber: Kolom 'kab_kota' tidak tersedia atau kosong";
            return null;
        }

        return new Industry([
            'industry_ptname' => $row['Nama Perusahaan'],
            'industry_headoffice_address' => $row['Alamat Kantor Pusat'],
            'industry_office_province' => $row['Provinsi Kantor'],
            'industry_city_office' => $row['Kabkota Kantor'],
            'industry_factory_address' => $row['Alamat Pabrik'],
            'industry_factory_province' => $row['Provinsi Pabrik'],
            'region_id' => $matchingRegion->region_id,
            'industry_kd_kbli' => $row['KBLI'],
            'industry_business_fields' => $row['Bidang Usaha'] ?? null,
            'industry_business_scale' => $row['Skala Usaha'],
            'industry_registered_sinas' => $row['Terdaftar di SIINas (Ya/Tidak)']
        ]);
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
