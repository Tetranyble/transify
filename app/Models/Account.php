<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance', 'account_type_id', 'account_number'];


    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function accountType(){
        return $this->belongsTo(AccountType::class);
    }

//    public function getBalanceAttribute($value){
//        return money($value);
//    }
}
