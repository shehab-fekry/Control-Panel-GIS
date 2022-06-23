<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    // model that represent the school table and its relations
    use HasFactory;
    protected $fillable=[
        'code','name','lng','lit'
    ];
     // Get all of the admins for the School
    public function admins()
    {
        return $this->hasMany(User::class);
    }
     // Get all of the fathers for the School
    public function fathers()
    {
        return $this->hasMany(Father::class);
    }
     // Get all of the drivers for the School
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
     // Get all of the vehicles for the School
    public function vehicles()
    {
        return $this->hasMany(vehicle::class);
    }
     // Get all of the fathers for the School
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
     // Get all of the children for the School
    public function children()
    {
        return $this->hasManyThrough(Child::class, Father::class);
    }
}
