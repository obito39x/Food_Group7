<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class OderController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->query('search');
        $status = $request->query('status', 'Pending'); // Sử dụng giá trị mặc định là 'Pending'

        // Lọc đơn hàng theo trạng thái
        switch ($status) {
            case "Process":
                $ordersQuery = Order::where('status_id', 3);
                break;
            case "Completed":
                $ordersQuery = Order::where('status_id', 1);
                break;
            default:
                $ordersQuery = Order::where('status_id', 2); // Trạng thái mặc định
                break;
        }

        // Thêm điều kiện tìm kiếm nếu có
        if ($searchQuery) {
            $ordersQuery->where(function ($query) use ($searchQuery) {
                $query->where('email', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('fullname', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('phone', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('address', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('city', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('district', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('ward', 'LIKE', "%{$searchQuery}%");
            });
        }

        // Thực hiện truy vấn để lấy kết quả
        $orders = $ordersQuery->paginate(5);

        // Lấy tất cả sản phẩm và các item của đơn hàng từ database
        $order_items = OrderItem::all();
        $products = Product::all();

        return view('admin.Order.orders', compact('orders', 'order_items', 'products', 'searchQuery', 'status'));
    }
    public function comfirm($id)
    {
        Order::updateStatus($id, 3);
        return redirect()->route('dashboard.order');
    }
    public function history()
    {
        $account = Auth::user();

        $user = User::where('id_account', $account->id)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your order history.');
        }

        // Lấy danh sách đơn hàng của người dùng
        $orders = Order::where('id_user', $user->id)->orderBy('created_at', 'desc')->get();
        $order_items = OrderItem::all();
        $products = Product::all();
        
        if (Auth::check()) {
            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();

        } else {
            $notifications = [];
        }
        // Trả về view lịch sử đơn hàng
        return view('admin.Order.history', compact('orders', 'order_items', 'products', 'notifications'));
    }
    public function success(Request $request, $id)
    {
        // Cập nhật trạng thái đơn hàng
        Order::updateStatus($id, 1);

        // Xử lý đánh giá nếu có dữ liệu từ form đánh giá
        if ($request->has('comment') && $request->has('rating')) {
            $review = new Review();
            $review->order_id = $id;
            $review->comment = $request->input('comment');
            $review->rating = $request->input('rating');
            $review->save();
        }

        return redirect()->route('order.history')->with('success', 'Order marked as completed and review submitted.');
    }
    public function cancel($id)
    {
        // Tìm và xóa tất cả các mục đơn hàng có order_id bằng với $id
        OrderItem::where('order_id', $id)->delete();

        // Xóa đơn hàng có id bằng với $id
        Order::destroy($id);

        // Điều hướng người dùng trở lại trang lịch sử đơn hàng
        return redirect()->route('order.history');
    }
}
