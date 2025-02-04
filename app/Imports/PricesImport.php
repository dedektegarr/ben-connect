<?php
namespace App\Imports;

use App\Models\Price;
use App\Models\Region;
use App\Models\Variant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PricesImport implements ToModel, WithHeadingRow
{
    public $variants;
    public $regions;
    public $errors = [];
    private $rowNumber = 4;

    /**
     * Process data from collection after skipping the header.
     */
    public function __construct()
    {
        $this->variants = Variant::select('variants_id','variants_name')->get();
        $this->regions = Region::select('region_id','region_name')->get();
    }

    public function model(array $row)
    {
        $nama_kabupaten = $this->formatKabupaten($row['kabupaten_kota']);
        $variant_name = trim($row['nama_variant']);
        $variants = $this->variants->where('variants_name', $variant_name)->first();
        $regions = $this->regions->where('region_name', $nama_kabupaten)->first();
        $rowNumber = $this->getRowNumber();

        // Validasi jika region atau variant tidak ditemukan
        if (!$variants) {
            $this->errors[] = "Baris {$rowNumber} - Variant '{$variant_name}' tidak ditemukan.";
            return null;
        }

        if (!$regions) {
            $this->errors[] = "Baris {$rowNumber} - Region '{$nama_kabupaten}' tidak ditemukan.";
            return null;
        }

        // Menyimpan harga dan tanggal dalam array
        $pricesData = [];

        // Loop untuk setiap kolom dalam baris data
        foreach ($row as $key => $value) {
            // Cek apakah key sesuai dengan format tanggal angka (contoh: 200125)
            if ($this->isValidDate($key)) {
                $dateFormatted = $this->formatDate($key);

                if (!$this->isValidFormattedDate($dateFormatted)) {
                    $this->errors[] = "Baris {$rowNumber} - Format tanggal '{$key}' salah.";
                    continue;
                }

                if (empty($value)) {
                    $this->errors[] = "Baris {$rowNumber} - Harga untuk tanggal {$dateFormatted} kosong.";
                    continue;
                }

                // Menyimpan harga dan tanggal ke dalam array
                $pricesData[] = [
                    "prices_value" => $value,
                    "date" => $dateFormatted,
                    "variants_id" => (string) $variants->variants_id,
                    "region_id" => (string) $regions->region_id,
                ];
            }
        }

        // Jika tidak ada harga yang ditemukan, kembalikan null
        if (empty($pricesData)) {
            return null;
        }

        // Insert harga dan tanggal ke dalam database
        foreach ($pricesData as $data) {
            // Menggunakan data yang sudah diformat untuk setiap harga dan tanggal
            return new Price($data);
        }
    }

    /**
     * Fungsi untuk mengecek apakah key adalah tanggal angka (contoh: 200125)
     */
    private function isValidDate($date)
    {
        // Memastikan bahwa tanggal berupa angka 6 digit (YYMMDD)
        return preg_match('/^\d{6}$/', $date);
    }

    /**
     * Fungsi untuk memformat tanggal dari angka (YYMMDD) ke d/m/y
     */
    private function formatDate($date)
    {
        // Memformat tanggal dari 200125 menjadi 20/01/25
        $year = substr($date, 0, 2); // Menyaring dua digit pertama sebagai tahun
        $month = substr($date, 2, 2); // Menyaring dua digit berikutnya sebagai bulan
        $day = substr($date, 4, 2); // Menyaring dua digit terakhir sebagai hari

        // Mengembalikan tanggal dalam format d/m/y
        return "$day/$month/$year";
    }

    private function isValidFormattedDate($date)
    {
        return preg_match('/^\d{2}\/\d{2}\/\d{2}$/', $date);
    }

    /**
     * Define the header row in the spreadsheet.
     */
    public function headingRow(): int
    {
        return 4; // Header is in the 4th row (index 3)
    }

    private function formatKabupaten($value)
    {
        return str_replace("Kab. ", "Kabupaten ", $value);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getRowNumber()
    {
        return $this->rowNumber++;
    }
}
