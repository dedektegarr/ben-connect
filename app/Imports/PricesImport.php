<?php
namespace App\Imports;

use App\Models\Price;
use App\Models\Region;
use App\Models\Variant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PricesImport implements ToModel, WithHeadingRow
{
    public $variants;
    public $regions;
    /**
     * Process data from collection after skipping the header.
     */
    public function __construct()
    {
        $this->variants=Variant::select('variants_id','variants_name')->get();
        $this->regions=Region::select('region_id','region_name')->get();
    }

    public function model(array $row)
    {
        $nama_kabupaten=$this->formatKabupaten($row['kabupaten_kota']);
        $variant_name = trim($row['nama_variant']);
        $variants=$this->variants->where('variants_name',$variant_name)->first();
        $regions=$this->regions->where('region_name',$nama_kabupaten)->first();

        // Cek apakah variant dan region ditemukan
        if (!$variants || !$regions) {
            // Log error atau tangani sesuai kebutuhan
            // \Log::error("Data tidak ditemukan: variant_name = $variant_name, region_name = $nama_kabupaten");
            return null; // Melewatkan baris ini jika data tidak ditemukan
        }

        $variants_id = (string) $variants->variants_id;
        $regions_id = (string) $regions->region_id;

        dd($variants_id,$regions_id);
        return new Price([
            "prices_value"=>"1000",
            "date"=>"2024-02-02",
            "variants_id"=>$variants_id,
            "region_id"=>$regions_id,
        ]);
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
}
