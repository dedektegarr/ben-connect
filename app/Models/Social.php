<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory, HasUuids;
    protected $table = "social";
    protected $primaryKey = "social_id";
    public $incrementing = false; // Pastikan UUID digunakan
    protected $keyType = 'string';

    public $fillable = [
        'region_id',
        'have',
        'dataset_id',
        'social_category_id',
        'nothing',
        'date_notice',
        'count',
    ];

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function dataset()
    {
        return $this->belongsTo(Dataset::class, 'dataset_id');
    }

    public function socialcategory()
    {
        return $this->belongsTo(SocialCategory::class, 'social_category_id');
    }
}
