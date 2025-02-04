<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Variant extends Model
{
    use HasFactory, HasUuids;
    protected $table = "variants";
    protected $primaryKey = "variants_id";
    public $incrementing = false; // Pastikan UUID digunakan
    protected $keyType = 'string';

    public $fillable = [
        'variants_name',
    ];
    
    public function price()
    {
        return $this->hasMany(Price::class, 'variants_id', 'variants_id');
    }
}
