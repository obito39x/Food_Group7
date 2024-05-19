<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Blog extends Model
{
    protected $primaryKey = 'id_blog';
    protected $fillable = ['title',
                        'id_user',
                        'content',
                        'created_at',
                        'updated_at',
                        'view_count',
                        'like_count',
                        'comment',
                        'img',
                        'status'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
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
    
    public function likers()
    {
        return $this->belongsToMany(User::class, 'blog_likes', 'blog_id', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }
       
    use HasFactory;
}
