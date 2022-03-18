<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Father extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
        'name','email','password','school_id','confirmed','mobileNumber','trip_id','status','region','lng','lit','image_path'
    ];
    protected $hidden = [
        'password',
        'api_token',

    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function child()
    {
        return $this->hasMany(Child::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
