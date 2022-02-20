<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','trip_id','status','long','lit'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function child()
    {
        return $this->hasMany(Child::class);
    }
}
