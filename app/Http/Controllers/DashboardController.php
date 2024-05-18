<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedStatus = $request->input('status');

        $new_order = Order::getOrdersLast24Hours();
        $visitors = User::count();
        $total_sales = Order::totalRevenue();

        $ordersQuery = Order::orderBy('created_at', 'desc');
        // Xử lý tìm kiếm nếu có
        if ($request->has('text')) {
            $searchText = $request->input('text');
            $users = User::where('username', 'LIKE', "%{$searchText}%")->limit(10)->get();
            $userIds = $users->pluck('id')->toArray();
            $orders = $ordersQuery->whereIn('id_user', $userIds)->limit(10)->get();
        } 
            
        
        if (!empty($selectedStatus)) {
            $ordersQuery->whereIn('status_id', $selectedStatus);
        }

        // Truy vấn các đơn hàng
        $orders = $ordersQuery->limit(10)->get();
        $states = Status::all();
        return view('admin.main', compact('new_order', 'visitors', 'total_sales', 'orders','states'));
    }

    public function mystore()
    {
        return view('admin.mystore');
    }
}
