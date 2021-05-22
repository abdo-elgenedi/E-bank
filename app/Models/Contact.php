<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table='contact_us';
    protected $fillable=[
        'f_name','l_name','email','subject','message'
    ];

    public $timestamps=false;
}
