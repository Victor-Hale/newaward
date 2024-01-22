<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    protected $table = "learning";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
