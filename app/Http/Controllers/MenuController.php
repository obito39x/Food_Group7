<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenuController extends Controller
{
    // Phương thức index để hiển thị trang menu
    public function index()
    {
        // Lấy tất cả sản phẩm từ model Product
        $products = Product::all();
        
        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('home.menu')->with('products', $products);
    }
}
