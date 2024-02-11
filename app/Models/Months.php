<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Months extends Model
{
    use HasFactory;
    protected $table="months_master";
    protected $fillable=
    [
        'month_name'
    ];
    public function payments():HasMany
    {
        return $this->hasMany(Amount::class,'month_id');
    }
}
