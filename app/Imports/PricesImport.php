<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Price;
use App\Models\Variant;
use App\Models\Region;
use Illuminate\Support\Facades\Log;

class PricesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public $variants;
    public $regions;
    public $errors = [];
    private $rowNumber = 4;
    private $batchSize = 1000;
    private $pricesData = [];

    public function __construct()
    {
        $this->variants = Variant::select('variants_id', 'variants_name')->get();
        $this->regions = Region::select('region_id', 'region_name')->get();
    }

    public function model(array $row)
    {
        $nama_kabupaten = $this->formatKabupaten($row['kabupaten_kota']);
        $nama_kabupaten_muko_muko=$this->formatKabupatenMuko($nama_kabupaten);

        $variant_name = trim($row['nama_variant']);
        $variants = $this->variants->where('variants_name', $variant_name)->first();
        $regions = $this->regions->where('region_name', $nama_kabupaten_muko_muko)->first();
        $rowNumber = $this->getRowNumber();

        if (!$variants) {
            $this->errors[] = "Baris {$rowNumber} - Variant '{$variant_name}' tidak ditemukan.";
            return null;
        }

        if (!$regions) {
            $this->errors[] = "Baris {$rowNumber} - Region '{$nama_kabupaten}' tidak ditemukan.";
            return null;
        }

        foreach ($row as $key => $value) {
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

                $this->pricesData[] = [
                    "prices_value" => $value,
                    "date" => $dateFormatted,
                    "variants_id" => (string) $variants->variants_id,
                    "region_id" => (string) $regions->region_id,
                ];
            }
        }

        if (count($this->pricesData) >= $this->batchSize) {
            $this->saveBatch();
        }

        return null;
    }

    private function saveBatch()
    {
        foreach ($this->pricesData as $data) {
            Price::updateOrCreate(
                [
                    'variants_id' => $data['variants_id'],
                    'region_id' => $data['region_id'],
                    'date' => $data['date']
                ],
                [
                    'variants_id' => $data['variants_id'],
                    'region_id' => $data['region_id'],
                    'date' => $data['date'],
                    'prices_value' => $data['prices_value']
                ]
            );
        }
        $this->pricesData = [];
    }

    public function __destruct()
    {
        $this->saveBatch();
    }

    private function isValidDate($date)
    {
        return preg_match('/^\d{6}$/', $date);
    }

    private function formatDate($date)
    {
        $year = '20' . substr($date, 0, 2);
        $month = substr($date, 2, 2);
        $day = substr($date, 4, 2);
        return "$year-$month-$day"; // Format untuk database
    }

    private function isValidFormattedDate($date)
    {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date);
    }

    public function headingRow(): int
    {
        return 4;
    }

    private function formatKabupaten($value)
    {
        return str_replace("Kab. ", "Kabupaten ", $value);
    }

    private function formatKabupatenMuko($value)
    {
        return str_replace("Kabupaten Muko Muko", "Kabupaten Muko-muko", $value);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getRowNumber()
    {
        return $this->rowNumber++;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
