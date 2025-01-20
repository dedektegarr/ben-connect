<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory, HasUuids;
    protected $table = "dataset";
    protected $primaryKey = "dataset_id";
    public $fillable = [
        'dataset_year'
    ];
    
    public function road(){
        return $this->hasMany(Road::class, 'road_id', 'road_id');
    }
}
