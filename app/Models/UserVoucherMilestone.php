<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVoucherMilestone extends Model
{
    use HasFactory;
    protected $table = 'user_voucher_milestones'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'user_id', // ID của người dùng
        'milestone', // Mốc doanh thu
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
