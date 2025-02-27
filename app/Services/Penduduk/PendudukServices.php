<?php

namespace App\Services\Penduduk;

class PendudukServices
{
    public function getGenderPercentage($penduduk)
    {
        $maleTotal = collect($penduduk)->sum("population_male");
        $femaleTotal = collect($penduduk)->sum("population_female");

        return [
            "values" => [
                round(($maleTotal / ($maleTotal + $femaleTotal)) * 100, 1),
                round(($femaleTotal / ($maleTotal + $femaleTotal)) * 100, 1)
            ],
            "labels" => ["Pria", "Wanita"]
        ];
    }

    public function getTotal($data, $key)
    {
        return collect($data)->sum($key);
    }

    public function getAgeRange($penduduk)
    {
        $data = collect($penduduk)->sortBy("population_age_group.population_age_group_years")->groupBy("population_age_group.population_age_group_years");

        return [
            "categories" => $data->keys()->toArray(),
            "series" => [
                [
                    "name" => "Pria",
                    "color" => "#31C48D",
                    "data" => $data->map(function ($group) {
                        return $group->sum('population_male');
                    })->values()->toArray()
                ],
                [
                    "name" => "Wanita",
                    "color" => "#F05252",
                    "data" => $data->map(function ($group) {
                        return $group->sum('population_female');
                    })->values()->toArray()
                ],
                [
                    "name" => "Total",
                    "color" => "#2b7fff",
                    "data" => $data->map(function ($group) {
                        return $group->sum('population_female') + $group->sum('population_male');
                    })->values()->toArray()
                ],
            ]
        ];
    }
}
