<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialCategory extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'social_category';
    protected $primaryKey = 'social_category_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'social_category_name',
    ];

    public function social()
    {
        return $this->hasMany(Social::class, 'social_id');
    }
}
