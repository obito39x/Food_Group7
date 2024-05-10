<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function profile(){
        $account = Auth::user();
        $user = $account->user;
        return view('profile.profile', ['profile' => $user]);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id . '|unique:accounts,email,' . $user->account->id,
        ]);
        $data = $request->only(['username', 'fullname', 'email', 'phone_number', 'gender', 'date_user', 'img']);
        

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img_profile'), $filename);
            $data['img'] = '/img_profile/' . $filename;
        }

        $user->update($data);
        return redirect()->back();
    }

}
 