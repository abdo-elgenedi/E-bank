<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutusShortcut extends Model
{
    protected $table='aboutus_shortcuts';

    protected $fillable=[
      'head','paragraph','image','status'
    ];

    public function scopeActive($query){

        return $query -> where('status','1');
    }

    public $timestamps = false;
}
