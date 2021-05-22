<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $table='accounts';
    protected $fillable = [
        'id', 'password', 'bank_id','balance',
    ];

    public $timestamps=false;
}
