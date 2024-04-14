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
        $req->merge(['password'=>Hash::make($req->password)]);
        //validate
        try {
            $account = Account::create($req->all());
            User::create([
                'id_account' => $account->id,
                'username' => $req->username,
                'email' => $req->email
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
        // dd($req->all());
        return redirect()->route('login');
    }
    public function postLogin(Request $req){
        if(Auth::attempt(['username' => $req->username, 'password' => $req->password])){
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Account or password is incorrect!');
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
}
