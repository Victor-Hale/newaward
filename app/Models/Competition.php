<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = "competition";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
