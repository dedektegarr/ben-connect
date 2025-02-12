<?php

namespace App\Imports;

use App\Models\Region;
use App\Models\SchoolLevelModel;
use App\Models\Student;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentCountImport implements ToModel, WithHeadingRow
{
    private $rowNumber;
    private $regions;
    private $levels;
    private $levelMapping;

    public function __construct()
    {
        $this->regions = array_map("strtolower", Region::pluck("region_name", "region_id")->toArray());
        $this->levels = array_map("strtolower", SchoolLevelModel::pluck("school_level_name", "school_level_id")->toArray());
    }

    public function model($row)
    {
        ++$this->rowNumber;

        // Cek apakah level sekolah pada header sudah lengkap dan dapatkan nomor kolom nya
        if ($this->rowNumber === 1) {
            $this->levelMapping = $this->getSchoolLevelMapping($row);
            ++$this->rowNumber;
            return null;
        }

        // Lewati baris total, baris 2, dan baris yang kosong
        if ($row[1] == "Total" || !array_filter($row) || $this->rowNumber === 3) return null;

        // bandingkan data foreign key dari excel dengan db
        $regionInExcel = $this->regionFormat(trim($row[1]));
        $regionExists = array_search($regionInExcel, $this->regions);

        if (!$regionExists) {
            throw new Exception("Baris " . ++$this->rowNumber . ": Data {$regionInExcel} pada kolom wilayah tidak tersedia");
        }

        $schoolData = [];

        foreach ($this->levelMapping as $level => $startColumn) {
            $levelExists = array_search(strtolower($level), $this->levels);

            if (!$levelExists) {
                throw new Exception("Baris " . ++$this->rowNumber . ": Kolom {$level} tidak ditemukan");
            }

            Student::updateOrCreate([
                "school_level_id" => $levelExists,
                "region_id" => $regionExists,
                "male_count" => $row[$startColumn + 1],
                "female_count" => $row[$startColumn + 2],
            ]);
        }

        return $schoolData;
    }

    public function startRow(): int
    {
        return 2;
    }

    private function regionFormat($value)
    {
        $region = strtolower($value);
        $replaced = str_replace("kab.", "kabupaten", $region);

        return $replaced;
    }

    private function getSchoolLevelMapping($row)
    {
        $validLevel = [];
        $levelInExcel = array_map("strtolower", array_filter($row));

        foreach ($this->levels as $levelId => $level) {
            $levelExists = array_search($level, $levelInExcel);

            if ($levelExists === false) {
                throw new Exception("Header tidak sesuai: Kolom '{$level}' tidak ada");
            }

            $validLevel[$level] = $levelExists;
        }

        return $validLevel;
    }
}
