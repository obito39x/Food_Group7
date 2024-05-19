<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Notification;
use App\Models\UserVoucherMilestone;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;
use Illuminate\Support\Str;

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
        if (Auth::check()) {


            $account = Auth::user();

            $user = User::where('id_account', $account->id)->first();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to view your order history.');
            }

            // Lấy danh sách đơn hàng của người dùng
            $orders = Order::where('id_user', $user->id)->orderBy('created_at', 'desc')->get();
            $order_items = OrderItem::all();
            $products = Product::all();
            return view('admin.Order.history', compact('orders', 'order_items', 'products'));
        }
        return redirect()->route('login')->with('error', 'Please login to view your order history.');
        
    }
    public function success(Request $request, $id)
    {
        // Cập nhật trạng thái đơn hàng
        Order::updateStatus($id, 1);
        $order = Order::find($id);
        if ($order->total_amount >= 200) {
            // Tạo mã voucher cho tài khoản mới
            $voucher = Voucher::create([
                'code' => $this->generateUniqueVoucherCode(),
                'discount_value' => 20, // Giả sử tặng voucher giảm giá 10%
                'expiry_date' => now()->addMonth(1), // Ví dụ: voucher hết hạn sau 1 tháng
                'user_id' => $order->id_user,
                'description' => "Giảm 20$"
            ]);
        }
        $account = Auth::user();
        $loyalCustomersRevenue = Order::where('id_user', $account->user->id)->sum('total_amount');
        $milestones = [
            3000 => 100, // Mốc doanh thu 3000 với voucher giảm giá 100₫
            2000 => 80,  // Mốc doanh thu 2000 với voucher giảm giá 80₫
            1000 => 30,  // Mốc doanh thu 1000 với voucher giảm giá 30₫
        ];

        foreach ($milestones as $milestone => $discountValue) {
            // Kiểm tra xem người dùng đã nhận voucher cho mốc này chưa
            $voucherExists = UserVoucherMilestone::where('user_id', $account->user->id)
                                                 ->where('milestone', $milestone)
                                                 ->exists();
            if ($loyalCustomersRevenue >= $milestone && !$voucherExists) {
                // Tạo mã voucher cho khách hàng trung thành
                Voucher::create([
                    'code' => $this->generateUniqueVoucherCode(),
                    'discount_value' => $discountValue,
                    'expiry_date' => now()->addMonth(1),
                    'user_id' => $account->user->id,
                    'description' => "Giảm " . $discountValue . "$"
                ]);

                // Lưu thông tin về mốc doanh thu đã được nhận
                UserVoucherMilestone::create([
                    'user_id' => $account->user->id,
                    'milestone' => $milestone
                ]);
            }
        }
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
    // Tạo mã voucher duy nhất
    private function generateUniqueVoucherCode()
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (Voucher::where('code', $code)->exists());

        return $code;
    }
}
