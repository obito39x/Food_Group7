<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class DashboardController extends Controller
{
    public function index()
    {
        $new_order = Order::getOrdersLast24Hours();
        $visitors = User::all()->count();
        $total_sales = Order::totalRevenue();
        return view('admin.main', compact('new_order', 'visitors', 'total_sales'));
    }
    public function mystore()
    {
        return view('admin.mystore');
    }
    public function blogs()
    {
        $blogs = Blog::where('status', 'pending')->orderBy('created_at', 'desc')->get();


        return view('admin.blogs', compact('blogs'));
    }
}
