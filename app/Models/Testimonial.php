<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table='testimonials';

    protected $fillable=[
      'customer_id','opinion','status'
    ];

    public function scopeActive($query){

        return $query -> where('status','1');
    }

    public function customer(){
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public $timestamps=false;
}
