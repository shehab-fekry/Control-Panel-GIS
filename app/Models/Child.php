<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','status','father_id','image_path','age','class','gender'
    ];

    public function father()
    {
        return $this->belongsTo(Father::class);
    }
}
