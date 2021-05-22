<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table='gallery';

    protected $fillable=[
        'image','status'
    ];

    public function scopeActive($query){

        return $query -> where('status','1');
    }

    public $timestamps = false;
}
