<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = "student_id";
    protected $guarded = ["student_id"];
}
