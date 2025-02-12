<?php

namespace App\Imports;

use App\Models\Kesehatan\DataRS\CategoryHospitalModel;
use App\Models\Kesehatan\DataRS\HospitalAcreditationModel;
use App\Models\Kesehatan\DataRS\HospitalDataModel;
use App\Models\Kesehatan\DataRS\HospitalOwnershipModel;
use App\Models\Region;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HospitalImport implements ToModel, WithHeadingRow
{
    private $regions;
    private $acreditations;
    private $ownerships;
    private $categories;
    private $rowNumber = 0;

    public function __construct()
    {
        $this->regions = Region::pluck("region_name", "region_id")->toArray();
        $this->acreditations = HospitalAcreditationModel::pluck("hospital_acreditation_name", "hospital_acreditation_id")->toArray();
        $this->ownerships = HospitalOwnershipModel::pluck("hospital_ownership_name", "hospital_ownership_id")->toArray();
        $this->categories = CategoryHospitalModel::pluck("category_hospital_name", "category_hospital_id")->toArray();
    }

    public function model(array $row)
    {
        // Inisiasi nomor baris
        $this->rowNumber++;
        $rowNumber = $this->rowNumber;

        // Mengubah data foreign key ke huruf kecil
        $regions = array_map("strtolower", $this->regions);
        $acreditations = array_map("strtolower", $this->acreditations);
        $ownerships = array_map("strtolower", $this->ownerships);
        $categories = array_map("strtolower", $this->categories);

        // mengambil data di excel untuk dibandingkan dengan data foreign key
        $regionInExcel = strtolower($this->regionFormat(trim($row["kabkota"] ?? '')));
        $acreditationInExcel = strtolower($row['status_akreditasi_rumah_sakit'] ?? '');
        $ownershipInExcel = strtolower($row['kepemilikan'] ?? '');
        $categoryInExcel = strtolower($row['jenis'] ?? '');

        // jika baris kosong, lewati
        if (
            empty($regionInExcel) &&
            empty($acreditationInExcel) &&
            empty($ownershipInExcel) &&
            empty($categoryInExcel)
        ) {
            return null;
        }

        // Periksa apakah data dari excel sesuai dengan yang ada di database
        $regionExists = array_search($regionInExcel, $regions);
        $acreditationExists = array_search($acreditationInExcel, $acreditations);
        $ownershipExists = array_search($ownershipInExcel, $ownerships);
        $categoryExists = array_search($categoryInExcel, $categories);

        if (!$regionExists) {
            throw new Exception("Baris {$rowNumber}: data '{$regionInExcel}' pada kolom kab/kota tidak tersedia");
        }
        if (!$acreditationExists) {
            throw new Exception("Baris {$rowNumber}: data '{$acreditationInExcel}' pada kolom status akreditasi tidak tersedia");
        }
        if (!$ownershipExists) {
            throw new Exception("Baris {$rowNumber}: data '{$ownershipInExcel}' pada kolom kepemilikan tidak tersedia");
        }
        if (!$categoryExists) {
            throw new Exception("Baris {$rowNumber}: data '{$categoryInExcel}' pada kolom jenis tidak tersedia");
        }

        // buat data rumah sakit baru atau update data yang sudah ada
        HospitalDataModel::updateOrCreate([
            "category_hospital_id" => $categoryExists ?? null,
            "hospital_acreditation_id" => $acreditationExists ?? null,
            "region_id" => $regionExists ?? null,
            "hospital_ownership_id" => $ownershipExists ?? null,
            "hospital_data_name" => $row["nama_rumah_sakit"] ?? "",
            "hospital_data_nib" => $row["nibsio"] ?? "",
            "hospital_data_class" => $row["kelas"] ?? "",
            "hospital_data_telp" => $row["telepon"] ?? "",
            "hospital_data_email" => $row["e_mail"] ?? "",
            "hospital_data_longitude" => $row["longitude"] ?? null,
            "hospital_data_latitude" => $row["latitude"] ?? null
        ]);
    }

    private function regionFormat($value)
    {
        $region = strtolower($value);

        // Mengubah format region sesuai dengan data master
        $containsCity = $region == "bengkulu" || $region == 'kota bengkulu' || !$value;
        $containsMukoMuko = str_contains($region, "muko muko");

        if ($containsCity) {
            return $region;
        }

        if ($containsMukoMuko) {
            $region = str_replace($region, "muko muko", "muko-muko");
        }

        return "kabupaten " . $region;
    }
}
