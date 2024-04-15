<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\About;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 3 sản phẩm có lượt rating cao nhất
        $topRatedProducts = Product::orderByDesc('rating')->take(3)->get();
        $about = About::all();
        $image_path = Gallery::all();
        // Trả về view 'home' và truyền dữ liệu sản phẩm vào view
        return view('home.home', compact('topRatedProducts', 'about', 'image_path'));
    }
    public function Menu()
    {
        // Lấy tất cả sản phẩm từ model Product
        $products = Product::all();
        
        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('home.menu')->with('products', $products);
    }
    public function Gallery()
    {
        // Lấy tất cả sản phẩm từ model Product
        $image_path = Gallery::all();
        
        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('home.gallery')->with('image_path', $image_path);
    }

}
