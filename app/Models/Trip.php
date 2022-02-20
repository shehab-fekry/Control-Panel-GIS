<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable=[
'driver_id','status'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function father()
    {
        return $this->hasMany(Father::class);
    }
}
