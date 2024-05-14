<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    public function login() {
        return view('login.login');
    }
    public function register(){
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
            $account = Account::create([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => $req->password,
            ]);
            User::create([
                'id_account' => $account->id,
                'username' => $validatedData['username'],
                'email' => $validatedData['email']
            ]);
        } catch (\Throwable $th) {
            // Xử lý lỗi nếu có
            return redirect()->back()->withErrors('Unable to create account. Please try again.');
        }
    
        return redirect()->route('login');
    }    
    public function postLogin(Request $req){
        // $validate = $req->only('username', 'password');
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            return redirect()->route('home'); 
        }
        return redirect()->back()->with('error', 'Invalid username or password.');
    }
    public function logout(){
        Auth::logout();
        return redirect()->back();
    }
    public function checkCredentials(Request $request){
        $usernameExists = User::where('username', $request->username)->exists();
        $emailExists = User::where('email', $request->email)->exists();

        return response()->json([
            'username_exists' => $usernameExists,
            'email_exists' => $emailExists,
        ]);
    }
    //thay đổi mật khẩu
    public function changePassword(Request $req){
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
