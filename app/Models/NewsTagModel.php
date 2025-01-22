<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsTagModel extends Model
{
    protected $table = 'news_tag';
    use HasUuids;
    protected $primaryKey = "news_id";
    public $timestamps = true;


    // Menentukan kolom yang akan diisi oleh mass-assignment
    protected $fillable = ['news_id', 'tag_id'];

    protected static function boot()
    {
        parent::boot();

        // Membuat UUID secara otomatis saat membuat record baru
        static::creating(function ($newsTag) {
            if (empty($newsTag->news_tag_id)) {
                $newsTag->news_tag_id = (string) Str::uuid();  // Menetapkan UUID baru untuk news_tag_id
            }
        });
    }
}
