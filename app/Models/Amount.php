<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Amount extends Model
{
    use HasFactory;
    protected $table="amount_table";
    protected $fillable=[
        'student_id',
        'admin_id',
        'year_id',
        'month_id',
        'amount'
    ];
    public function months():BelongsTo
    {
        return $this->belongsTo(Months::class,'month_id');
    }

    public function student():BelongsTo
    {
        return $this->belongsTo(UserMaster::class,'student_id');
    }
}
