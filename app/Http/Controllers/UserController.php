<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(){
    $account = Auth::user();
    $user = $account->user;
    return view('profile.profile', ['profile' => $user]);
}

}
