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
        $sortBy = $request->input('filter');

        // Lấy query và category từ request
        $query = $request->input('query');
        $categoryId = $request->input('category');
        // Tạo query dựa trên query và category
        $productsQuery = Product::query();

        // Tìm kiếm theo query nếu có
        if ($query) {
            $productsQuery->where('name', 'LIKE', "%{$query}%");
        }

        // Lọc sản phẩm theo danh mục nếu có
        if ($categoryId && $categoryId != 'all') {
            $productsQuery->where('id_categories', $categoryId);
        }

        // Lấy danh sách sản phẩm đã lọc hoặc tất cả sản phẩm nếu không có lọc
        $products = $productsQuery->paginate(2)->appends(request()->query());

        // Lấy danh sách danh mục
        $categories = Categorie::all();
        if ($sortBy == "best_selling") {
            if($categoryId == 'all'){
                $topSellingProducts = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                ->join('categories', 'products.id_categories', '=', 'categories.id_category')
                ->select('order_items.product_id', 'products.name as product_name', 'categories.name as category_name', OrderItem::raw('SUM(order_items.quantity) as total_quantity'))
                ->groupBy('order_items.product_id', 'products.name', 'categories.name')
                ->orderByDesc('total_quantity')
                ->limit(10)
                ->get();
            }else{
                $topSellingProducts = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                ->join('categories', 'products.id_categories', '=', 'categories.id_category')
                ->select('order_items.product_id', 'products.name as product_name', 'categories.name as category_name', OrderItem::raw('SUM(order_items.quantity) as total_quantity'))
                ->where('categories.id_category', '=', $categoryId)
                ->groupBy('order_items.product_id', 'products.name', 'categories.name')
                ->orderByDesc('total_quantity')
                ->limit(10)
                ->get();
            }
            

            // Khởi tạo mảng để lưu trữ các sản phẩm bán chạy nhất
            $product_filter = [];
            foreach ($topSellingProducts as $topSellingProduct) {
                $product = Product::find($topSellingProduct->product_id);
                $product_filter[] = $product;
            }
            // Gán danh sách sản phẩm bán chạy nhất vào danh sách sản phẩm chính
            $products = new LengthAwarePaginator(
                $product_filter, // Mảng sản phẩm
                count($product_filter), // Tổng số sản phẩm
                9, // Số lượng sản phẩm trên mỗi trang
                LengthAwarePaginator::resolveCurrentPage(), // Trang hiện tại
                ['path' => LengthAwarePaginator::resolveCurrentPath()] // Các đường dẫn cần thiết
            );
        }

        return view('home.menu', compact('products', 'categories'));
    }
}
