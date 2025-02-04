<?php

namespace App\Imports;

use App\Models\Price;
use App\Models\Region;
use App\Models\Variant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class PricesImport implements ToCollection
{
    /**
    * @param array collection
    */

    private $errors = [];
    private $dataToInsert = []; // Array untuk menyimpan data sementara

    public function collection(Collection $rows)
    {
        // Ambil header tanggal dari baris ke-2 (indeks 1)
        $dates = array_slice($rows[1]->toArray(), 3); // Mengambil tanggal yang dimulai dari kolom ke-4 (indeks 3)

        // Validasi format tanggal
        foreach ($dates as $index => $date) {
            if (!is_numeric($date)) {
                $this->errors[] = "Format tanggal salah di kolom ke-" . ($index + 3) . " (Harus dalam format Excel date)";
            }
        }

        // Jika ada error tanggal, hentikan proses import
        if (!empty($this->errors)) {
            return;
        }

        // Proses data mulai dari baris ke-3 (indeks 2)
        foreach ($rows->slice(2) as $rowIndex => $row) {
            $rowNumber = $rowIndex + 3; // Menyesuaikan nomor baris Excel

            // Konversi format region dari "Kab . X" menjadi "Kabupaten X"
            $regionName = isset($row[0]) ? trim(str_replace('Kab . ', 'Kabupaten ', $row[0])) : null;
            $variantName = $row[1] ?? null;

            // Validasi data kosong
            if (!$regionName) {
                $this->errors[] = "Baris $rowNumber: Region kosong";
            }
            if (!$variantName) {
                $this->errors[] = "Baris $rowNumber: Variant kosong";
            }

            // Cari region_id dan variants_id dari database
            $region = Region::where('region_name', $regionName)->first();
            $variant = Variant::where('variants_name', $variantName)->first();

            if (!$region) {
                $this->errors[] = "Baris $rowNumber: Region '$regionName' tidak ditemukan";
            }

            if (!$variant) {
                $this->errors[] = "Baris $rowNumber: Variant '$variantName' tidak ditemukan";
            }

            // Jika ada error, lewati proses penyimpanan untuk baris ini
            if (!$region || !$variant) {
                continue;
            }

            // Loop setiap harga berdasarkan tanggal
            foreach ($dates as $index => $excelDate) {
                $priceValue = $row[$index + 2] ?? null;

                // Periksa apakah harga kosong untuk tanggal tertentu
                if ($priceValue === null) {
                    $formattedDate = ExcelDate::excelToDateTimeObject($excelDate)->format('d/m/y');
                    $this->errors[] = "Baris $rowNumber: Harga kosong untuk tanggal " . $formattedDate;
                    continue;
                }

                // Format tanggal menjadi format Excel date yang sesuai
                $formattedDate = ExcelDate::excelToDateTimeObject($excelDate)->format('Y-m-d');

                // Simpan ke array sementara dengan format yang benar
                $this->dataToInsert[] = [
                    'region_id' => $region->region_id,
                    'variants_id' => $variant->variants_id,
                    'date' => $formattedDate, // Format tanggal diubah
                    'prices_value' => $priceValue
                ];
            }
        }

        // Jika ada error, hentikan proses tanpa menyimpan ke database
        if (!empty($this->errors)) {
            return;
        }

        // Jika tidak ada error, masukkan semua data ke database dalam satu batch
        Price::insert($this->dataToInsert);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
