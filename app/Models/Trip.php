<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable=[
'driver_id','status','geofence','school_id'
    ];

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function father()
    {
        return $this->hasMany(Father::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function children()
    {
        return $this->hasManyThrough(Child::class, Father::class);

    }
    public function vehicle()
    {
        return $this->hasManyThrough(vehicle::class, Driver::class);
    }
}
