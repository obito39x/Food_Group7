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

    public function updateProfile(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);
        $data = $request->only(['username', 'fullname', 'email', 'phone_number', 'gender', 'date_user', 'img']);
        
        // Kiểm tra email có bị trùng lặp không
        if ($request->email !== $user->email && User::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'The email has already been taken.']);
        }

        //xử lý tải hình ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img_profile'), $filename);
            $data['img'] = '/img_profile/' . $filename;
        }

        $user->update($data);
        return redirect()->back();
    }
    public function toggleFollow($id)
    {
        try {
            $userToFollow = User::findOrFail($id);
            $account = Auth::user();
            $currentUser = $account->user;

            if ($currentUser->following()->where('following_user_id', $id)->exists()) {
                $currentUser->following()->detach($id);
                $isFollowing = false;
            } else {
                $currentUser->following()->attach($id);
                $isFollowing = true;
            }

            return response()->json([
                'success' => true,
                'following' => $isFollowing
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }    
}
 