<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['id_account', 'username', 'fullname', 'email', 'phone_number', 'gender', 'date_user', 'img'];

    // public function account(){
    //     return $this->hasOne(Account::class, 'id_account', 'id');
    // }
    public function account(){
    return $this->belongsTo(Account::class, 'id_account', 'id');
}

}
