<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type',
        'content',
        'blog_id',
        'is_read',
    ];

    // Mối quan hệ với User (người dùng)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Mối quan hệ với Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
    public function getTimeDiff()
    {
        $date = $this->created_at;
        $now = Carbon::now();
        $diff = $date->diff($now);

        if ($diff->days < 1) {
            return $date->diffForHumans(); // Hiển thị như "5 giờ trước", "30 phút trước"
        } elseif ($diff->days < 3) {
            return $diff->days . ' ngày trước';
        } else {
            return $date->format('d-m-Y'); // Định dạng ngày tháng năm
        }
    }
}
