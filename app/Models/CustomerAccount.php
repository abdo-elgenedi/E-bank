<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    public $table='customer_accounts';
    protected $fillable = [
        'customer_id', 'account_id', 'bank_id',
    ];

    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id','id');
    }
    public $timestamps=false;
}
