<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    protected $table="department";
    protected $fillable=[
        'admin_id','department_name'
    ];
    public function userMaster():HasMany
    {
        return $this->hasMany(UserMaster::class,'dept_id');
    }
}
