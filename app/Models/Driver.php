<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];
    /**
     * Get the user associated with the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trip()
    {
        return $this->hasOne(Trip::class);
    }
}
