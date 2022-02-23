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
       'email','name','password','licenseNumber','confirmed','mobileNumber'
    ];
    protected $hidden = [
        'password',
        'remember_token',

    ];

    public function trip()
    {
        return $this->hasOne(Trip::class);
    }
}
