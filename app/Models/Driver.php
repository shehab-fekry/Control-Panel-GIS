<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
       'email','name','school_id','trip_id','password','licenseNumber','confirmed','mobileNumber','image_path'
    ];
    protected $hidden = [
        'password',
        'api_token',

    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
