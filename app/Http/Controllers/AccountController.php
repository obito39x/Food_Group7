<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            Account::create($req->all());
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
}
