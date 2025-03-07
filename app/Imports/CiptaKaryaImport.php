<?php

namespace App\Imports;

use App\Models\Ciptakarya;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CiptaKaryaImport implements ToCollection, WithStartRow, WithCalculatedFormulas
{
    /**
     * @param Collection $collection
     */

    public function startRow(): int
    {
        return 7;
    }

    public function collection(Collection $collection)
    {

        $data = [];

        foreach ($collection as $key => $row) {
            if ($row[0] === null || $row[1] === null) {
                continue;
            }

            $data[] = [
                "indikator_sasaran" => $row[1],
                "target" => (float)$row[4],
                "persentase_capaian" => ((float)$row[9] < 1) ? number_format((float)$row[9] * 100, 2) : (float)$row[9],
                "faktor_pendorong" => $row[10],
                "faktor_penghambat" => $row[11],
                "rekom_tindak_lanjut" => $row[12],
            ];
        }

        foreach ($data as $ciptakarya) {
            Ciptakarya::updateOrCreate($ciptakarya);
        }
    }
}
