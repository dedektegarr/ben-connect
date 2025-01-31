<?php

namespace App\Imports;

use App\Models\Population;
use App\Models\PopulationAgeGroup;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Collection;

HeadingRowFormatter::default('none');

class PopulationImport implements ToModel, ToCollection, WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $region = [];
    private $regionField = array();
    private $ageGroup = [];
    private $ageGroupField = [];

    public function collection(Collection $rows)
    {
        //Mengambil seluruh kelompok umur
        $getAgeGroup = PopulationAgeGroup::get();
        //Format kelompok umur menyesuaikan format excel
        $formattedAgeMale = '';
        $formattedAgeFemale = '';
        foreach($getAgeGroup as $age){
            if(str_contains($age->population_age_group_years, '-')){
                $ages = explode('-', $age->population_age_group_years);
                $startAge = $ages[0];
                $endAge = $ages[1];
                if(strlen($startAge) == 1){
                    $startAge = '0'.$startAge;
                }
                if(strlen($endAge) == 1){
                    $endAge = '0'.$endAge;
                }
                $formattedAgeMale = $startAge.'-'.$endAge.'(LK)';
                $formattedAgeFemale = $startAge.'-'.$endAge.'(PR)';

            }else{
                $formattedAgeMale = $age->population_age_group_years.'(LK)';
                $formattedAgeFemale = $age->population_age_group_years.'(PR)';
            }
            $ageGroupMale = ['age_group_id'=>$age->population_age_group_id, 'age_group_years'=>$formattedAgeMale];
            $ageGroupFemale = ['age_group_id'=>$age->population_age_group_id, 'age_group_years'=>$formattedAgeFemale];
            
            array_push($this->ageGroup, $ageGroupMale);
            array_push($this->ageGroup, $ageGroupFemale);    
            
            $this->ageGroupField[$age->population_age_group_id] = [$formattedAgeMale, $formattedAgeFemale];
        }
        //Membuat array header
        $headers = collect($this->ageGroup);
        $headers = $headers->pluck('age_group_years')->toArray();
        array_push($headers, 'WILAYAH');

        //Validasi header
        $headersInFile = $rows->first()->keys()->toArray();
        $missingHeaders = array_diff($headers, $headersInFile);

        //Kirim error jika terdapat perbedaan atau kekurangan header
        if (!empty($missingHeaders)) {
            $missingHeadersString = implode(', ', $missingHeaders);
            throw new \Exception("File import tidak lengkap, header berikut tidak ada:  $missingHeadersString");
        }

        //Mengambil seluruh wilayah database
        $getRegion = Region::get();
        foreach($getRegion as $reg){
            $regs = ['region_id'=>$reg->region_id, 'region_name'=>strtoupper($reg->region_name)];
            array_push($this->region, $regs);
            $this->regionField[$reg->region_id] = $reg->region_name;
        }
        $region = collect($this->region);

        //Validasi nama wilayah
        $regionsInFile = $rows->pluck('WILAYAH')->unique()->toArray();
        $regionsInValidate = $region->pluck('region_name')->toArray();
        $missingRegions = array_diff($regionsInValidate, $regionsInFile);

        //Kirim error jika terdapat perbedaan atau kekurangan data wilayah
        if (!empty($missingRegions)) {
            $missingRegionsString = implode(', ', $missingRegions);
            $x = json_encode($this->ageGroupField);
            throw new \Exception("File import tidak lengkap, wilayah berikut tidak ada:  $missingRegionsString");
        }
    }

    public function model(array $row)
    {   
        // $r = array_search('Kaur', $this->regionField);
        // Population::create([
        //     'population_period_id' => '9e159fb3-3ff2-4933-8e90-5a1d004ae8b5',
        //     'region_id' => $r,
        // ]);
    }
}
