<?php

namespace App\Livewire\Penduduk;

use App\Services\ApiClient;
use Livewire\Component;

class StatistikPenduduk extends Component
{
    private $apiClient;
    public $regions;
    public $ageRange;
    public $selectedRegion;
    public $genderPercentage;
    public $populationCount;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
        $this->apiClient->setToken(request()->session()->get("auth_token"));
    }

    public function loadData($region = null)
    {
        $penduduk = $this->apiClient->get("/kependudukan/data", ["region" => $region])["data"];

        $this->regions = $this->apiClient->get("/wilayah/data", [])["data"];
        $this->genderPercentage = $this->getGenderPercentage($penduduk);
        $this->ageRange = $this->getAgeRange($penduduk);
        $this->populationCount = [
            "Pria" => $this->getTotal($penduduk, "population_male"),
            "Wanita" => $this->getTotal($penduduk, "population_female"),
            "Total" => $this->getTotal($penduduk, "population_male") +  $this->getTotal($penduduk, "population_female")
        ];
    }

    public function mount()
    {
        $this->loadData();
    }

    public function updatedSelectedRegion($value)
    {
        $this->loadData($value);

        $this->dispatch(
            "data-changed",
            $this->genderPercentage,
            $this->ageRange
        );
    }

    private function getTotal($data, $key)
    {
        return collect($data)->sum($key);
    }

    private function getGenderPercentage($penduduk)
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

    private function getAgeRange($penduduk)
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

    public function render()
    {
        return view('livewire.penduduk.statistik-penduduk');
    }
}
