<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){

        if (Auth::check()) {

            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        } else {
            $notifications = [];
        }
        // Lấy người dùng hiện tại
        $user = Auth::user();

        // Lấy danh sách sản phẩm yêu thích của người dùng
        $wishlistItems = Wishlist::where('user_id', $user->user->id)->with('product')->get();

        // Trả về view và truyền danh sách sản phẩm yêu thích
        return view('home.wishlist', compact('wishlistItems','notifications'));
    }
}
