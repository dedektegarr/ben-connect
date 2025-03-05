<?php

namespace App\Imports;

use App\Models\Road;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class JalanImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    public function startRow(): int
    {
        return 7;
    }
    public function model(array $row)
    {
        if ($row[1] !== null) {
            return new Road([
                'nama_ruas' => $row[1] ?? null,
                'panjang_ruas' => $row[2] ?? null,
                'dari_km' => $row[3] ?? null,
                'sampai_km' => $row[4] ?? null,
                'kondisi_baik_km' => $row[5] ?? null,
                'kondisi_sedang_km' => $row[6] ?? null,
                'kondisi_rusak_ringan_km' => $row[7] ?? null,
                'kondisi_rusak_berat_km' => $row[8] ?? null,
                'kondisi_baik_persentase' => $row[9] ?? null,
                'kondisi_sedang_persentase' => $row[10] ?? null,
                'kondisi_rusak_ringan_persentase' => $row[11] ?? null,
                'kondisi_rusak_berat_persentase' => $row[12] ?? null,
            ]);
        }
    }
}
