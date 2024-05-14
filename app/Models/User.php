<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = ['id_account', 'username', 'fullname', 'email', 'phone_number', 'gender', 'date_user', 'img'];
    // public function account(){
    //     return $this->hasOne(Account::class, 'id_account', 'id');
    // }
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            if ($user->isDirty('email')) {  // Kiểm tra xem 'email' có được thay đổi hay không
                $user->account()->update([
                    'email' => $user->email
                ]);
            }
        });
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'id_account');
    }
    public function findById($id)
    {
        return User::find($id);
    }
}
