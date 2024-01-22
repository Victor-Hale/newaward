<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sci extends Model
{
    protected $table = "sci";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
