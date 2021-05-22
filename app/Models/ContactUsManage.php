<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsManage extends Model
{
    protected $table='contact_us_manage';

    protected $fillable=[
        'address','mobile','email','form_status'
    ];

    public $timestamps=false;
}
