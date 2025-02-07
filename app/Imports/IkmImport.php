<?php

namespace App\Imports;

use App\Models\Ikm;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class IkmImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    protected $year;
    protected $regions;
    public $errors = [];
    private $batchSize = 1000;

    public function __construct($year)
    {
        $this->year = $year;
        $this->regions = Region::select('region_id', 'region_name')->get();
    }

    public function model(array $row)
    {
        $rowNumber = $row['no'] ?? null; 

        $kabKota = $row['kab_kota'] ?? '';

        if (empty($kabKota)) {
            $this->errors[] = "Baris $rowNumber: Kolom 'kab_kota' kosong atau tidak ditemukan.";
            return null;
        }

        $normalizedRegion = strtolower(trim(str_replace(' ', '', $kabKota)));
        $matchingRegion = $this->regions->first(function ($region) use ($normalizedRegion) {
            return strtolower(str_replace(' ', '', $region->region_name)) === $normalizedRegion;
        });

        if (!$matchingRegion) {
            return null;
        }

        return new Ikm([
            'ikm_ptname' => $row['nama_perusahaan'],
            'ikm_owner_name' => $row['nama_pemilik'],
            'ikm_contact' => $row['kontak_person'] ?? null,
            'ikm_sentra' => $row['sentra'] ?? null,
            'ikm_address_street' => $row['jalan'],
            'ikm_address_village' => $row['desa_kelurahan'],
            'ikm_address_subdistrict' => $row['kecamatan'],
            'region_id' => $matchingRegion->region_id,
            'ikm_form' => $row['bentuk_badan_usaha'],
            'ikm_number' => $row['nomor_izin'] ?? null,
            'ikm_kd_kbli' => $row['kode_kbli'],
            'ikm_category_product' => $row['jenis_produk'],
            'ikm_branch' => $row['cabang_industri'],
            'ikm_count' => $row['jumlah_tenaga_kerja'],
            'year' => $this->year
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
