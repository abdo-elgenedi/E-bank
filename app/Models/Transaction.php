<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'id', 'sender_id', 'receiver_id','amount','status','details','created_at'
    ];

    public function senders(){
        return $this->belongsTo(User::class,'sender_id','id');
    }

    public function receivers(){
        return $this->belongsTo(User::class,'receiver_id','id');
    }


public $timestamps=false;
    protected $dates=[
        'created_at'
    ];
}
