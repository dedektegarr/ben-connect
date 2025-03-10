<?php

namespace App\Imports;

use App\Models\Bridge;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class JembatanImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    private $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function startRow(): int
    {
        return 6;
    }

    public function model(array $row)
    {
        if ($row[2] !== null) {
            Bridge::updateOrCreate([
                'nama_jembatan' => $row[2],
                'nama_ruas_jalan' => $row[3],
                'panjang' => str_replace(',', '.', $row[4]),
                'lebar' => str_replace(',', '.', $row[5]),
                'jumlah_bentang' => $row[6],
                'bangunan_atas_tipe' => $row[7],
                'bangunan_atas_tipe_2' => $row[8],
                'bangunan_atas_kondisi' => $row[9],
                'bangunan_bawah_tipe' => $row[10],
                'bangunan_bawah_kondisi' => $row[11],
                'fondasi_tipe' => $row[12],
                'fondasi_kondisi' => $row[13],
                'lantai_jembatan_tipe' => $row[14],
                'lantai_jembatan_kondisi' => $row[15],
                'sungai_tipe' => $row[16],
                'sungai_kondisi' => $row[17],
                'tahun_konstruksi' => $row[18],
                'tahun' => $this->year,
                'tahun_survei' => $row[19],
                'NK' => $row[20],
                'status' => $row[21],
            ]);
        }
    }
}
