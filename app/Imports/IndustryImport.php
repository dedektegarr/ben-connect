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
        //Cek apakah semua kolom penting kosong
        $isEmptyRow = empty($row['nama_perusahaan']) &&
            empty($row['kbli']);

        if ($isEmptyRow) {
            return null;
        }

        if (empty(array_filter($row))) {
            return null;
        }

        $this->rowCount++;
        $rowNumber = $this->rowCount;

        $kabKota = $row['kabkota_pabrik'] ?? '';
        $normalizedRegion = strtolower(trim(str_replace(' ', '', $kabKota)));
        $matchingRegion = $this->regions->first(function ($region) use ($normalizedRegion) {
            $regionNormalized = strtolower(str_replace([' ', '-'], '', $region->region_name));
            return $regionNormalized === $normalizedRegion;
        });
        
        // Jika tidak ada kecocokan dengan region yang tersedia tampil pesan error
        if (!$matchingRegion) {
            $this->errors[] = "Baris $rowNumber: Kolom 'kab/kota' tidak tersedia atau kosong";
            return null;
        }

        //Cek apakah data sudah ada di database
        $existingIkm = Industry::where('industry_ptname', $row['nama_perusahaan'])
            ->where('industry_kd_kbli', $row['kbli'])
            ->where('region_id', $matchingRegion->region_id)
            ->first();

        if ($existingIkm) {
            // Jika data sudah ada, perbarui data
            $existingIkm->update([
                'industry_ptname' => $row['nama_perusahaan'] ?? null,
                'industry_headoffice_address' => $row['alamat_kantor_pusat'] ?? null,
                'industry_office_province' => $row['provinsi_kantor'] ?? null,
                'industry_city_office' => $row['kabkota_kantor'] ?? null,
                'industry_factory_address' => $row['alamat_pabrik'] ?? null,
                'industry_factory_province' => $row['provinsi_pabrik'] ?? null,
                'region_id' => $matchingRegion->region_id,
                'industry_kd_kbli' => $row['kbli'] ?? null,
                'industry_business_fields' => $row['bidang_usaha'] ?? null,
                'industry_business_scale' => $row['skala_usaha'] ?? null,
                'industry_registered_sinas' => $row['terdaftar_di_siinas_yatidak'] ?? null
            ]);

            return null; // Lewati insert karena sudah diperbarui
        }

        return new Industry([
            'industry_ptname' => $row['nama_perusahaan'] ?? null,
            'industry_headoffice_address' => $row['alamat_kantor_pusat'] ?? null,
            'industry_office_province' => $row['provinsi_kantor'] ?? null,
            'industry_city_office' => $row['kabkota_kantor'] ?? null,
            'industry_factory_address' => $row['alamat_pabrik'] ?? null,
            'industry_factory_province' => $row['provinsi_pabrik'] ?? null,
            'region_id' => $matchingRegion->region_id,
            'industry_kd_kbli' => $row['kbli'] ?? null,
            'industry_business_fields' => $row['bidang_usaha'] ?? null,
            'industry_business_scale' => $row['skala_usaha'] ?? null,
            'industry_registered_sinas' => $row['terdaftar_di_siinas_yatidak'] ?? null
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
