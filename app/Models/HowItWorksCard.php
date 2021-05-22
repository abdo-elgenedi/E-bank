<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWorksCard extends Model
{
    protected $table='howitworkscards';

    protected $fillable=[
      'head','paragraph','image','status'
    ];

    public function scopeActive($query){

        return $query -> where('status','1');
    }

    public $timestamps=false;
}
