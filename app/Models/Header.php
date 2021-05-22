<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table='header';

    protected $fillable=[
        'head','paragraph','status'
    ];

    public function scopeActive($query){

        return $query -> where('status','1');
    }

    public $timestamps = false;
}
