<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    use HasFactory;
    protected $fillabxwle=[
        'licensePlate','model','color','driver_id','model','school_id'
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

}
