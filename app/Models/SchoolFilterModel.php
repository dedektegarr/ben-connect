<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFilterModel extends Model
{
    use HasFactory;
    use HasUuids;

    public $table = "school_filter";
    public $primaryKey = "school_filter_id";
    public $timestamps = true;

    public $fillable = [
        'school_id',
        'dataset_id',
        'school_filter_total_teacher',
        'school_filter_total_student'
    ];

    public function school(){
        return $this->belongsTo(SchoolModel::class, 'school_id', 'school_id');
    }

    public function dataset(){
        return $this->belongsTo(Dataset::class, 'dataset_id', 'dataset_id');
    }

    public function getLatestYearStatistics()
    {
        // Ambil tahun terakhir dari tabel dataset
        $latestYear = Dataset::max('dataset_year');

        // Ambil data statistik berdasarkan tahun terakhir
        $data = self::selectRaw(
                'region.region_name, school_level.school_level_name,
                COUNT(*) as total_schools,
                SUM(school_filter_total_student) as total_students,
                SUM(school_filter_total_teacher) as total_teachers'
            )
            ->join('school', 'school_filter.school_id', '=', 'school.school_id')  // Gabungkan dengan tabel school
            ->join('region', 'school.region_id', '=', 'region.region_id') // Gabungkan dengan tabel region
            ->join('school_level', 'school.school_level_id', '=', 'school_level.school_level_id') // Gabungkan dengan tabel school level
            ->whereHas('dataset', function ($query) use ($latestYear) {
                $query->where('dataset_year', $latestYear);
            })
            ->groupBy('region.region_name', 'school_level.school_level_name') // Kelompokkan berdasarkan region dan level sekolah
            ->get();

        $result = [];

        foreach ($data as $item) {
            $regionName = $item->region_name;
            $schoolLevelName = $item->school_level_name;

            // Inisialisasi tahun
            if (!isset($result[$latestYear])) {
                $result[$latestYear] = [
                    "total_schools" => 0,
                    "total_students" => 0,
                    "total_teachers" => 0,
                    "regions" => []
                ];
            }

            // Inisialisasi region
            if (!isset($result[$latestYear]["regions"][$regionName])) {
                $result[$latestYear]["regions"][$regionName] = [
                    "total_schools" => 0,
                    "total_students" => 0,
                    "total_teachers" => 0,
                    "levels" => []
                ];
            }

            // Inisialisasi level sekolah
            if (!isset($result[$latestYear]["regions"][$regionName]["levels"][$schoolLevelName])) {
                $result[$latestYear]["regions"][$regionName]["levels"][$schoolLevelName] = [
                    "total_schools" => 0,
                    "total_students" => 0,
                    "total_teachers" => 0
                ];
            }

            // Update data level sekolah
            $result[$latestYear]["regions"][$regionName]["levels"][$schoolLevelName]["total_schools"] += $item->total_schools;
            $result[$latestYear]["regions"][$regionName]["levels"][$schoolLevelName]["total_students"] += $item->total_students;
            $result[$latestYear]["regions"][$regionName]["levels"][$schoolLevelName]["total_teachers"] += $item->total_teachers;

            // Update data region
            $result[$latestYear]["regions"][$regionName]["total_schools"] += $item->total_schools;
            $result[$latestYear]["regions"][$regionName]["total_students"] += $item->total_students;
            $result[$latestYear]["regions"][$regionName]["total_teachers"] += $item->total_teachers;

            // Update data tahun
            $result[$latestYear]["total_schools"] += $item->total_schools;
            $result[$latestYear]["total_students"] += $item->total_students;
            $result[$latestYear]["total_teachers"] += $item->total_teachers;
        }

        return $result;
    }
}
