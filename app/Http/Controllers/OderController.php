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
    public function index()
    {
        $orders = Order::all();
        $order_items = OrderItem::all();
        $products = Product::all();
        return view('admin.Order.orders', compact('orders', 'order_items', 'products'));
    }
}
