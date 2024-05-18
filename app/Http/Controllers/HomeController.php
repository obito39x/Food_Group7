<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\About;
use App\Models\Categorie;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Termwind\Components\Dd;
use Illuminate\Pagination\LengthAwarePaginator;


class HomeController extends Controller
{
    public function index()
    {
        // Lấy 3 sản phẩm có lượt rating cao nhất
        $topRatedProducts = Product::orderByDesc('rating')->take(3)->get();
        $about = About::all();
        $image_path = Gallery::take(3)->get();
        // Trả về view 'home' và truyền dữ liệu sản phẩm vào view
        return view('home.home', compact('topRatedProducts', 'about', 'image_path'));
    }
    // public function menu(Request $request)
    // {
    //     // Lấy query và category từ request
    //     $query = $request->input('query');
    //     $categoryId = $request->input('category');

    //     // Tạo query dựa trên query và category
    //     $productsQuery = Product::query();

    //     // Tìm kiếm theo query nếu có
    //     if ($query) {
    //         $productsQuery->where('name', 'LIKE', "%{$query}%");
    //     }

    //     // Lọc sản phẩm theo danh mục nếu có
    //     if ($categoryId && $categoryId != 'all') {
    //         $productsQuery->where('id_categories', $categoryId);
    //     }

    //     // Lấy danh sách sản phẩm đã lọc hoặc tất cả sản phẩm nếu không có lọc
    //     $products = $productsQuery->paginate(9)->appends(request()->query());

    //     return view('home.menu', compact('products'));
    // }
    public function addToCart(Request $request)
    {
        $id = $request->input('productId');
        $product = Product::findOrfail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->id,
                "quantity" => 1,
                "price" => $product->new_price,
                "image" => $product->image_url
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('sucess', 'prodcut...');
    }
    public function gallery()
    {
        // Lấy tất cả sản phẩm từ model Product
        $image_path = Gallery::all();

        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('home.gallery')->with('image_path', $image_path);
    }


    public function about()
    {
        $about = About::all();

        return view('home.about')->with('about', $about);
    }
    public function menu(Request $request)
    {
        // Lấy query từ request
        $query = $request->input('query');

        // Lấy danh sách các category được chọn từ các checkbox
        $selectedCategories = $request->input('category');

        // Tạo query để lấy sản phẩm
        $productsQuery = Product::query();

        // Tìm kiếm theo query nếu có
        if ($query) {
            $productsQuery->where('name', 'LIKE', "%{$query}%");
        }

        // Lọc sản phẩm theo các danh mục được chọn nếu có
        if (!empty($selectedCategories)) {
            $productsQuery->whereIn('id_categories', $selectedCategories);
        }
        $productsQuery->where('hide', true);
        // Lấy danh sách sản phẩm đã lọc hoặc tất cả sản phẩm nếu không có lọc
        $products = $productsQuery->paginate(9)->appends(request()->query());

        // Lấy danh sách danh mục
        $categories = Categorie::all();

        return view('home.menu', compact('products', 'categories'));
    }
}
