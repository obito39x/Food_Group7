<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Notification;
use App\Models\Voucher;
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
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your order.');
        } else {

            $profile = User::where('id_account', $user->id)->first();
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
            $userVouchers = Voucher::where('user_id', $profile->id)->get();
        }

        // Trả về view 'cart' và truyền danh sách sản phẩm vào view
        return view('cart.checkout', compact('products', 'profile', 'userVouchers'));
    }

    public function applyVoucher(Request $request)
    {
        // Lấy thông tin voucher từ request
        $voucherId = $request->input('voucher_id');
        $totalAmount = $request->input('total_amount');

        // Tìm voucher dựa trên ID
        $voucher = Voucher::find($voucherId);

        if ($voucher) {
            // Áp dụng giảm giá từ voucher vào tổng tiền
            $newTotalAmount = $totalAmount - $voucher->discount_value;

            // Trả về số tiền mới dưới dạng phản hồi JSON
            return response()->json(['new_total_amount' => $newTotalAmount]);
        }

        // Nếu không tìm thấy voucher, trả về tổng tiền ban đầu
        return response()->json(['new_total_amount' => $totalAmount]);
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
        $totalAmount = $request->input('total_amount');
        $status_id = 2;
        // Chuyển đổi chuỗi JSON thành một mảng PHP
        $products = json_decode($request->input('products'));


        // Tính tổng số tiền

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
                $order->id_user = $user->id;
                // Lấy danh sách các voucher đã sử dụng từ yêu cầu
                $id_vourcher = $request->input('voucher');
                Voucher::destroy($id_vourcher);
                
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
        return redirect()->route('order.history');
    }
    public function update(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            $quantity = 1;
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
        } else {
            $cart[$productId] = ['quantity' => $quantity];
        }

        session()->put('cart', $cart);

        // Tính tổng số tiền mới
        $totalAmount = 0;
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $totalAmount += $product->new_price * $item['quantity'];
            }
        }

        return response()->json(['success' => true, 'totalAmount' => $totalAmount]);
    }
   
}
