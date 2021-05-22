<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutusHeader extends Model
{
    protected $table='aboutus_headers';

    protected $fillable=[
      'head','paragraph','image','status'
    ];

    public function scopeActive($query){

        return $query -> where('status','1');
    }

    public $timestamps = false;
}
