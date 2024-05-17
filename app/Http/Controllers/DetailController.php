<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class DetailController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('menu')->with('error', 'Product not found.');
        }

        // Lấy các review cho sản phẩm
        $reviews = OrderItem::where('product_id', $id)
            ->join('reviews', 'order_items.order_id', '=', 'reviews.order_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('users', 'orders.id_user', '=', 'users.id')
            ->select('order_items.product_id', 'order_items.order_id', 'reviews.comment', 'users.username', 'reviews.rating', 'reviews.created_at')
            ->get();
        $product_relateds = Product::where('id_categories', $product->id_categories)
            ->where('id', '!=', $product->id)
            ->limit(3)
            ->get();
        return view('home.detail', compact('product', 'reviews', 'product_relateds'));
    }
    public function add(Request $request)
    {
        $id = $request->input('productId');
        $quantity = $request->input('quantity');
        $product = Product::findOrfail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->id,
                "quantity" => $quantity,
                "price" => $product->new_price,
                "image" => $product->image_url
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('sucess', 'prodcut...');
    }
}
