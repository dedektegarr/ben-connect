<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikm extends Model
{
    use HasFactory;

    protected $table = "ikms";
    protected $primaryKey = "ikm_id";
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'ikm_ptname',
        'ikm_owner_name',
        'ikm_contact',
        'ikm_sentra',
        'ikm_address_street',
        'ikm_address_village',
        'ikm_address_subdistrict',
        'region_id',
        'ikm_form',
        'ikm_number',
        'ikm_kd_kbli',
        'ikm_category_product',
        'ikm_branch',
        'ikm_count',
        'year'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');

    }
}
