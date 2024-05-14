<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Termwind\Components\Dd;
use Illuminate\Support\Facades\Auth;

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
    public function checkout()
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
        return view('cart.checkout', compact('products'));
    }
    public function saveorder(Request $request)
    {
        // Lấy giá trị từ request
        $email = $request->input('email');
        $fullname = $request->input('fullname');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');
        $district = $request->input('district');
        $ward = $request->input('ward');
        $totalAmount = 0;
        $status_id = 2;
        // Chuyển đổi chuỗi JSON thành một mảng PHP
        $products = json_decode($request->input('products'));


        // Tính tổng số tiền
        foreach ($products as $product) {
            $subtotal = $product->new_price * session()->get("cart.$product->id.quantity", 1);
            $totalAmount += $subtotal;
        }

        $paymentMethod = $request->input('payment_method');

        // Tạo một bản ghi mới trong bảng 'orders'
        $order = new Order();
        $order->email = $email;
        $order->fullname = $fullname;
        $order->phone = $phone;
        $order->address = $address;
        $order->city = $city;
        $order->district = $district;
        $order->ward = $ward;
        $order->payment_method = $paymentMethod;
        $order->total_amount = $totalAmount;
        $order->status_id = $status_id;
        if (Auth::check()) {
            // Người dùng đã đăng nhập
            $account = Auth::user();
           
            $user = User::where('id_account', $account->id)->first();
            if ($user) {
                
                // Tìm thấy người dùng có id_account tương ứng
                $order->id_user = $user->id_user;
            } 

            // $order->id_user = $user->id;
        }
        // Lưu bản ghi vào cơ sở dữ liệu
        $order->save();
        $order_id = $order->id;

        // Lưu các sản phẩm đơn hàng vào bảng 'order_items'
        foreach ($products as $product) {
            $product_id = $product->id;
            $quantity = session()->get("cart.$product->id.quantity", 1);

            // Tạo một bản ghi mới trong bảng 'order_items'
            $order_item = new OrderItem();
            $order_item->order_id = $order_id;
            $order_item->product_id = $product_id;
            $order_item->quantity = $quantity;
            $order_item->price = $product->new_price;
            // Lưu bản ghi vào cơ sở dữ liệu
            $order_item->save();
        }
        session()->forget('cart');
        return redirect()->route('cart');
    }
}
