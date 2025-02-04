<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PricesImport implements ToModel, WithHeadingRow
{
    /**
     * Process data from collection after skipping the header.
     */
    public function model(array $row)
    {
        // Ambil kolom dengan format tanggal (misal ddmmyy)
        $header = $row;  // Karena sudah merupakan array, ambil langsung
        $priceColumns = [];

        // Proses header untuk menentukan kolom yang berisi tanggal
        foreach ($header as $key => $value) {
            if (preg_match('/^\d{6}$/', $value)) { // Jika kolom sesuai format tanggal
                $priceColumns[] = $key; // Simpan kolom harga berdasarkan indeks
            }
        }

        // Ambil data region dan variant
        $region  = $row[1];
        $variant = $row[2];

        // Ambil harga berdasarkan kolom yang valid (tanggal)
        $prices = [];
        foreach ($priceColumns as $priceColumn) {
            $prices[$header[$priceColumn]] = $row[$priceColumn]; // Harga berdasarkan tanggal
        }

        // Return model yang akan di-save ke database
        return response()->json([
            'row'          => $row,
            'priceColumns' => $priceColumns ?? [],
            'prices'       => $prices ?? [],
        ]);
    }

    /**
     * Define the header row in the spreadsheet.
     */
    public function headingRow(): int
    {
        return 4; // Header is in the 4th row (index 3)
    }
}
