<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMaster extends Model
{
    use HasFactory;
    protected $table='students';
    protected $fillable=
    [
        'admin_id','name','gender','phone','address','dept_id'
    ];
    public function amounts():HasMany
    {
        return $this->hasMany(Amount::class,'student_id');
    }
    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class,'dept_id');
    }
}
