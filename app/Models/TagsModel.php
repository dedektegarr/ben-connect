<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = "tags";
    protected $primaryKey = "tag_id";
    public $fillable = [
        'tag_name',
    ];

    public function news()
    {
        return $this->belongsToMany(NewsModel::class, 'news_tag', 'tag_id', 'news_id');
    }
}
