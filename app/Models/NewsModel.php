<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "news";
    protected $primaryKey = "news_id";
    public $timestamps = true;
    public $fillable = [
        'news_title',
        'news_image',
        'news_description',
        'news_category',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(TagsModel::class, 'news_tag', 'news_id', 'tag_id');
    }
}
