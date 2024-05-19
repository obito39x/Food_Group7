<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Voucher;
use App\Notifications\VoucherNotification;

class AccountController extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    public function register()
    {
        return view('login.singup');
    }
    public function signup(Request $req){
        $validatedData = $req->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $req->merge(['password' => Hash::make($req->password)]);

        try {
            // Tạo tài khoản mới
            $account = Account::create([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => $req->password,
            ]);

            // Tạo user mới
            $user = User::create([
                'id_account' => $account->id,
                'username' => $validatedData['username'],
                'email' => $validatedData['email']
            ]);

            // Tạo mã voucher cho tài khoản mới
            $voucher = Voucher::create([
                'code' => $this->generateUniqueVoucherCode(),
                'discount_value' => 10, // Giả sử tặng voucher giảm giá 10%
                'expiry_date' => now()->addMonth(1), // Ví dụ: voucher hết hạn sau 1 tháng
                'user_id' => $user->id,
                'description' => "Giảm 10$"
            ]);

            // Gửi thông báo cho người dùng về việc nhận voucher
            

            // Đăng nhập người dùng sau khi đăng ký
            Auth::login($account);

            return redirect()->route('home')->with('success', 'Account created successfully.');
        } catch (\Throwable $th) {
            // Xử lý lỗi nếu có
            return redirect()->back()->withErrors('Unable to create account. Please try again.');
        }
    }
    // Tạo mã voucher duy nhất
    private function generateUniqueVoucherCode()
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (Voucher::where('code', $code)->exists());

        return $code;
    }
    public function postLogin(Request $req)
    {
        // $validate = $req->only('username', 'password');
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            $req->session()->flash('success', 'Login successfully');
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Invalid username or password.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
    public function checkCredentials(Request $request)
    {
        $usernameExists = User::where('username', $request->username)->exists();
        $emailExists = User::where('email', $request->email)->exists();

        return response()->json([
            'username_exists' => $usernameExists,
            'email_exists' => $emailExists,
        ]);
    }
    //thay đổi mật khẩu
    public function changePassword(Request $req)
    {
        $req->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại có khớp không
        if (!Hash::check($req->current_password, $user->password)) {
            // Nếu không khớp, thông báo lỗi
            return back()->withErrors(['current_password' => 'Current password is incorrect!']);
        }

        // Nếu khớp, cập nhật mật khẩu mới
        $user->password = Hash::make($req->new_password);
        $user->save();

        // Chuyển hướng người dùng đến trang chủ với thông báo thành công
        return redirect()->route('home');
    }
}
