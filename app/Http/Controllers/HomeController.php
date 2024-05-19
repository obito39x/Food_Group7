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
use App\Models\Wishlist;
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

        
        $blogs = Blog::orderBy('view_count', 'desc')->take(3)->get();

        // Kiểm tra và thêm thuộc tính 'is_liked' cho mỗi blog
        foreach ($blogs as $blog) {
            $blog->is_liked = $blog->likers->contains(Auth::id());
        }
        // Trả về view 'home' và truyền dữ liệu sản phẩm vào view
        return view('home.home', compact('topRatedProducts', 'about', 'image_path', 'blogs'));
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
    public function Wishlist(Request $request)
    {
        

        if (Auth::check()) {
            $user = Auth::user();
            $id_product = $request->input('productId');

            // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích của người dùng chưa
            $existingWishlistItem = Wishlist::where('user_id', $user->user->id)
                ->where('product_id', $id_product)
                ->first();

            if ($existingWishlistItem) {
                // Nếu sản phẩm đã tồn tại trong danh sách yêu thích, xóa nó đi
                $existingWishlistItem->delete();
                return response()->json(['isInWishlist' => false]);
            } else {
                // Nếu sản phẩm chưa tồn tại trong danh sách yêu thích, thêm nó vào
                $wishlist = new Wishlist();
                $wishlist->product_id = $id_product;
                $wishlist->user_id = $user->user->id;
                $wishlist->save();
                return response()->json(['isInWishlist' => true]);
            }
           
        } else {
            return response()->json(['error' => 'Please login to view your order history.'], 401);
        }
       
    }
    public function gallery()
    {
        // Lấy tất cả sản phẩm từ model Product
        $image_path = Gallery::all();

        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('home.gallery', compact('image_path'));
    }


    public function about()
    {
        $about = About::all();


        return view('home.about', compact('about'));
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
        if (Auth::check()) {
            $user = Auth::user();
            //Lấy danh sách wishlist
            $wishlist = Wishlist::where('user_id', $user->user->id)->get();
        }else{
            $wishlist = [];
        }

        // Lấy danh sách danh mục
        $categories = Categorie::all();

        return view('home.menu', compact('products', 'categories', 'wishlist'));
    }
}
