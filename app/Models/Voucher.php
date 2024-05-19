<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'discount_value',
        'expiry_date',
        'user_id',
    ];

    // Định dạng ngày hết hạn khi lấy từ cơ sở dữ liệu
    public function getExpiryDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    // Mối quan hệ với User (người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
