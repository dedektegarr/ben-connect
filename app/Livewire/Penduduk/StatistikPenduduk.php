<?php

namespace App\Livewire\Penduduk;

use App\Services\ApiClient;
use Livewire\Component;

class StatistikPenduduk extends Component
{
    private $apiClient;
    public $regions;
    public $selectedRegion;
    public $genderPercentage;
    public $populationCount;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
        $this->apiClient->setToken(request()->session()->get("auth_token"));
    }

    public function mount()
    {
        $penduduk = $this->apiClient->get("/kependudukan/data", [])["data"];

        $this->regions = $this->apiClient->get("/wilayah/data", [])["data"];
        $this->genderPercentage = $this->getGenderPercentage($penduduk);
        $this->populationCount = [
            "Pria" => $this->getTotal($penduduk, "population_male"),
            "Wanita" => $this->getTotal($penduduk, "population_female"),
            "Total" => $this->getTotal($penduduk, "population_male") +  $this->getTotal($penduduk, "population_female")
        ];
    }

    public function onRegionChange()
    {
        $penduduk = $this->apiClient->get("/kependudukan/data", ["region" => $this->selectedRegion])["data"];

        $this->genderPercentage = $this->getGenderPercentage($penduduk);
        $this->populationCount = [
            "Pria" => $this->getTotal($penduduk, "population_male"),
            "Wanita" => $this->getTotal($penduduk, "population_female"),
            "Total" => $this->getTotal($penduduk, "population_male") +  $this->getTotal($penduduk, "population_female")
        ];

        $this->dispatch(
            "data-changed",
            $this->genderPercentage
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

    public function render()
    {
        return view('livewire.penduduk.statistik-penduduk');
    }
}
