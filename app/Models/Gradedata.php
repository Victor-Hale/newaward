<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gradedata extends Model
{
    protected $table = "gradedata";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
