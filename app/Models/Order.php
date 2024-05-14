<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'orders';
    protected $fillable = ['email','fullname',	'phone'	,'address','city','district','ward','payment_method','total_amount','id_user'];
    public static function getOrdersLast24Hours()
    {
        return Order::where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->get();
    }
    public static function totalRevenue()
    {
        // Sử dụng hàm tĩnh sum() để tính tổng giá trị của trường total_amount
        return self::sum('total_amount');
    }
    public static function getByStatus($status)
    {
        return static::where('status_id', $status)->get();
    }
    public static function updateStatus($orderId, $newStatus)
    {
        $order = self::find($orderId);
        if ($order) {
            $order->status_id = $newStatus;
            return $order->save();
        }
        return false;
    }
}
