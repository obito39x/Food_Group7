<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 3 sản phẩm có lượt rating cao nhất
        $topRatedProducts = Product::orderByDesc('rating')->take(3)->get();
        
        // Trả về view 'home' và truyền dữ liệu sản phẩm vào view
        return view('home.home')->with('topRatedProducts', $topRatedProducts);
    }
}
