<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearModel extends Model
{
    use HasFactory;
    protected $table="year_master";
    protected $fillable=
    [
        'year'
    ];
}
