<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bridge extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ["bridge_id"];
    protected $primaryKey = "bridge_id";
    protected $keyType = "string";
    public $incrementing = false;
}
