<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    use HasFactory;
    protected $fillable=[
        'licensePlate','model','color','driver_id','model'
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
