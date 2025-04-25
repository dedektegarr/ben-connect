<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Price;
use App\Models\Variant;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PricesImport implements ToCollection, WithBatchInserts, WithChunkReading, WithStartRow
{
    public $variants;
    public $regions;
    public $errors = [];
    private $rowNumber = 4;
    private $batchSize = 1000;
    private $pricesData = [];

    public function __construct()
    {
        $this->variants = array_map("strtolower", Variant::pluck("variants_name", "variants_id")->toArray());
        $this->regions = array_map("strtolower", Region::pluck("region_name", "region_id")->toArray());
    }

    public function startRow(): int
    {
        return 4;
    }

    public function collection(Collection $collection)
    {
        $dates = $collection->first()->filter(fn($date) => $date !== null)->values();
        $data = $collection->slice(1)->map(function ($row) {
            return $row->filter(fn($value) => $value !== null);
        })->values();

        $insertData = [];
        $currentRegion = "";

        foreach ($dates as $i => $date) {
            foreach ($data as $row) {
                // bandingkan data foreign key region dari excel dengan db
                $regionInExcel = trim($row[1] ?? '');

                if ($regionInExcel !== '') {
                    $currentRegion = $this->regionFormat($regionInExcel);
                }

                $regionId = array_search($currentRegion, $this->regions);

                // bandingkan data foreign key variant dari excel dengan db
                $variantId = array_search(strtolower($row[2]), $this->variants);

                // Date Format
                $carbonDate = Carbon::createFromFormat('d/m/y', $date);

                $insertData[] = [
                    "region_id" => $regionId,
                    "variants_id" => $variantId,
                    "date" => $carbonDate->format('Y/m/d'),
                    "prices_value" => $row[$i + 3],
                    "created_at" => now(),
                    "updated_at" => now()
                ];
            }
        }

        Price::insertOrIgnore($insertData);
    }

    private function regionFormat($value)
    {
        $region = strtolower($value);
        $replaced = str_replace("kab.", "kabupaten", $region);

        return $replaced;
    }

    // public function model(array $row)
    // {
    //     $nama_kabupaten = $this->formatKabupaten($row['kabupaten_kota']);
    //     $nama_kabupaten_muko_muko = $this->formatKabupatenMuko($nama_kabupaten);

    //     $variant_name = trim($row['nama_variant']);
    //     $variants = $this->variants->first(function ($item) use ($variant_name) {
    //         return strtolower($item->variants_name) === strtolower($variant_name);
    //     });

    //     $regions = $this->regions->first(function ($item) use ($nama_kabupaten_muko_muko) {
    //         return strtolower($item->region_name) === strtolower($nama_kabupaten_muko_muko);
    //     });
    //     $rowNumber = $this->getRowNumber();

    //     if (!$variants) {
    //         $this->errors[] = "Baris {$rowNumber} - Variant '{$variant_name}' tidak ditemukan.";
    //         return null;
    //     }

    //     if (!$regions) {
    //         $this->errors[] = "Baris {$rowNumber} - Region '{$nama_kabupaten}' tidak ditemukan.";
    //         return null;
    //     }

    //     foreach ($row as $key => $value) {
    //         if ($this->isValidDate($key)) {
    //             $dateFormatted = $this->formatDate($key);

    //             if (!$this->isValidFormattedDate($dateFormatted)) {
    //                 $this->errors[] = "Baris {$rowNumber} - Format tanggal '{$key}' salah.";
    //                 continue;
    //             }

    //             if (empty($value)) {
    //                 $this->errors[] = "Baris {$rowNumber} - Harga untuk tanggal {$dateFormatted} kosong.";
    //                 continue;
    //             }

    //             $this->pricesData[] = [
    //                 "prices_value" => $value,
    //                 "date" => $dateFormatted,
    //                 "variants_id" => (string) $variants->variants_id,
    //                 "region_id" => (string) $regions->region_id,
    //             ];
    //         }
    //     }

    //     if (count($this->pricesData) >= $this->batchSize) {
    //         $this->saveBatch();
    //     }

    //     return null;
    // }

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
        $day = substr($date, 0, 2);
        $month = substr($date, 2, 2);
        $year = '20' . substr($date, 4, 2);
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
