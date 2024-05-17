<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\About;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 3 sản phẩm có lượt rating cao nhất
        $topRatedProducts = Product::orderByDesc('rating')->take(3)->get();
        $about = About::all();
        $image_path = Gallery::take(3)->get();

        if(Auth::check()){

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        }
        else{
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
    public function menu(Request $request)
    {
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

        if(Auth::check()){

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        }
        else{
            $notifications = [];
        }

        return view('home.menu', compact('products', 'notifications'));
    }
    public function addToCart(Request $request)
    {
        $id = $request->input('productId');
        $product = Product::findOrfail( $id);
        $cart = session()->get('cart',[]);
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                "name" => $product->id,
                "quantity" => 1,
                "price" => $product->new_price,
                "image" => $product->image_url
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('sucess','prodcut...');
    }
    public function gallery()
    {
        // Lấy tất cả sản phẩm từ model Product
        $image_path = Gallery::all();
        if(Auth::check()){

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        }
        else{
            $notifications = [];
        }

        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('home.gallery', compact('image_path', 'notifications'));
    }


    public function about()
    {
        $about = About::all();

        if(Auth::check()){

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        }
        else{
            $notifications = [];
        }

        return view('home.about', compact('about', 'notifications'));
    }
}
