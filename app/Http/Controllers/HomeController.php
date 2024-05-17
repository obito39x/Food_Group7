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
use App\Models\Blog;
use App\Models\Notification;
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

        if (Auth::check()) {

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        } else {
            $notifications = [];
        }
        $blogs = Blog::orderBy('view_count', 'desc')->take(3)->get();

        // Kiểm tra và thêm thuộc tính 'is_liked' cho mỗi blog
        foreach ($blogs as $blog) {
            $blog->is_liked = $blog->likers->contains(Auth::id());
        }
        // Trả về view 'home' và truyền dữ liệu sản phẩm vào view
        return view('home.home', compact('topRatedProducts', 'about', 'image_path', 'notifications', 'blogs'));

    }
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
        if (Auth::check()) {

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        } else {
            $notifications = [];
        }

        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('home.gallery', compact('image_path', 'notifications'));
    }


    public function about()
    {
        $about = About::all();

        if (Auth::check()) {

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        } else {
            $notifications = [];
        }

        return view('home.about', compact('about', 'notifications'));
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
        $products = $productsQuery->paginate(9)->appends(request()->query());

        // Lấy danh sách danh mục
        $categories = Categorie::all();
        if ($sortBy == "best_selling") {
            if ($categoryId == 'all') {
                $topSellingProducts = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('categories', 'products.id_categories', '=', 'categories.id_category')
                    ->select('order_items.product_id', 'products.name as product_name', 'categories.name as category_name', OrderItem::raw('SUM(order_items.quantity) as total_quantity'))
                    ->groupBy('order_items.product_id', 'products.name', 'categories.name')
                    ->orderByDesc('total_quantity')
                    ->limit(10)
                    ->get();
            } else {
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
            $productCollection = collect($product_filter);

            // Lấy trang hiện tại từ request, mặc định là 1 nếu không có
            $currentPage = request()->input('page', 1);
            $perPage = 9; // Số lượng sản phẩm trên mỗi trang
            $currentPageItems = $productCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

            // Gán danh sách sản phẩm bán chạy nhất vào danh sách sản phẩm chính
            $products = new LengthAwarePaginator(
                $currentPageItems, // Các sản phẩm trên trang hiện tại
                $productCollection->count(), // Tổng số sản phẩm
                $perPage, // Số lượng sản phẩm trên mỗi trang
                $currentPage, // Trang hiện tại
                ['path' => request()->url(), 'query' => request()->query()] // Các đường dẫn cần thiết
            );

        }
        if (Auth::check()) {

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        } else {
            $notifications = [];
        }

        return view('home.menu', compact('products', 'categories', 'notifications'));
    }
}
