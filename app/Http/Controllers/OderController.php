<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class OderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        if($status == "Process"){
            $orders = Order::getByStatus(3);
        }
        else if($status == "Completed"){
            $orders = Order::getByStatus(1);
        }
        else{
            $orders = Order::getByStatus(2);
        }
        
        $order_items = OrderItem::all();
        $products = Product::all();
        return view('admin.Order.orders', compact('orders', 'order_items', 'products'));
    }
    public function comfirm($id){
        Order::updateStatus($id, 3);
        return redirect()->route('dashboard.order');
    }
    public function process()
    {
        $orders = Order::getByStatus(3);
        $order_items = OrderItem::all();
        $products = Product::all();
        return view('admin.Order.order_process', compact('orders', 'order_items', 'products'));
    }
}
