<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Termwind\Components\Dd;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);


        // Khởi tạo mảng để lưu trữ danh sách sản phẩm từ giỏ hàng
        $products = [];
    
        // Lặp qua các sản phẩm trong giỏ hàng
        foreach ($cart as $productId => $item) {
            // Tìm sản phẩm theo ID
            $product = Product::find($productId);
    
            // Kiểm tra xem sản phẩm có tồn tại không
            if ($product) {
                // Thêm sản phẩm vào mảng $products
                $products[] = $product;
            }
        }
    
        // Trả về view 'cart' và truyền danh sách sản phẩm vào view
        return view('cart.cart', compact('products'));
    }
    public function remove($id)
    {
        // Lấy dữ liệu giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($cart[$id])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$id]);

            // Cập nhật giỏ hàng trong session
            session()->put('cart', $cart);

            // Chuyển hướng người dùng trở lại trang giỏ hàng
            return redirect()->route('cart')->with('success', 'Product removed from cart.');
        }

        // Nếu sản phẩm không tồn tại trong giỏ hàng, chuyển hướng người dùng trở lại trang giỏ hàng với thông báo lỗi
        return redirect()->route('cart')->with('error', 'Product not found in cart.');
    }
    
}
