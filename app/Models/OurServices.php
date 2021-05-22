<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurServices extends Model
{
    protected $table='our_services';

    protected $fillable=[
      'head','paragraph','image','status'
    ];

    public function scopeActive($query){

        return $query -> where('status','1');
    }

    public $timestamps = false;
}
