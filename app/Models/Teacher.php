<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = "teacher_id";
    protected $guarded = ["teacher_id"];
}
