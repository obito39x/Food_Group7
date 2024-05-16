<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'blog_id',
        'comment',
        'created_at',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
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
    
    use HasFactory;
}
