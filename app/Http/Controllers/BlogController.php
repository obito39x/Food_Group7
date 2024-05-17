<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();

        // Kiểm tra và thêm thuộc tính 'is_liked' cho mỗi blog
        foreach ($blogs as $blog) {
            $blog->is_liked = $blog->likers->contains(Auth::id());
        }

        $account = Auth::user();
        $followedUsers = collect();
        if ($account) {
            $followedUsers = $account->user->following ?? collect();
        }
        $followers = collect();
        if ($account) {
            $followers = $account->user->followers ?? collect();
        } 
        if(Auth::check()){
            $account = Auth::user();
            $user = $account->user->id_user;
            $notifications = Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
            
        }
        else{
            $notifications = [];
        }
        return view('home.blog', compact('blogs', 'followedUsers', 'followers', 'notifications'));
    }
    public function view_profile()
    {
        $account = Auth::user(); // Lấy thông tin người dùng hiện tại
        $user = $account->user;
        return view('blog.create_blog', compact('user'));
    }
    public function create_blog(Request $req)
    {
        // Validate dữ liệu
        $req->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',  // Chỉ cho phép file ảnh, giới hạn size 2MB
        ]);

        // Xử lý file ảnh
        $imagePath = null;
        if ($req->hasFile('img')) {
            $file = $req->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img_blog'), $filename);
            $imagePath = '/img_blog/' . $filename;
        }
        $account = Auth::user(); // Lấy thông tin người dùng hiện tại

        $id_user = $account->user->id_user;

        // Tạo blog mới
        $blog = Blog::create([
            'title' => $req->title,
            'content' => $req->content,
            'img' => $imagePath,
            'id_user' => $id_user,
        ]);

        // Chuyển hướng về trang danh sách blog
        return redirect()->route('blog');
    }
    public function showBlog($id)
    {
        $blog = Blog::with([
            'user',
            'likers',
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);

        $blog->increment('view_count');
        $blog->is_liked = $blog->likers->contains(Auth::id());
        $blog->like_count = $blog->likers->count();

        return view('blog.post', compact('blog'));
    }
    public function deleteBlog($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Kiểm tra nếu người dùng là chủ của blog
            $account = Auth::user();
            $id_user = $account->user->id_user;
            if ($id_user !== $blog->id_user) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $blog->delete();

            return response()->json(['success' => true, 'content' => $blog->content]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateContent(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Kiểm tra quyền sở hữu blog
        $account = Auth::user();
        $id_user = $account->user->id_user;
        if ($id_user !== $blog->id_user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $blog->content = $request->content;
        $blog->save();

        return response()->json(['success' => true, 'content' => $blog->content]);
    }


    public function toggleLike($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $account = Auth::user();
            $user = $account->user;
            if ($user->likedBlogs()->where('id_blog', $id)->exists()) {
                $user->likedBlogs()->detach($id);
                $blog->decrement('like_count');
            } else {
                $user->likedBlogs()->attach($id);
                $blog->increment('like_count');
                $blog->increment('view_count');
            }
            // Tạo thông báo
            $notification = new Notification([
                'user_id' => $blog->id_user,
                'type' => 'like',
                'content' => $user->username . ' has liked your blog: ' . $blog->title,
                'blog_id' => $blog->id_blog,
                'is_read' => 0
            ]);
            $notification->save();

            return response()->json([
                'success' => true,
                'likes' => $blog->likers()->count(),
                'liked' => $user->likedBlogs()->where('id_blog', $id)->exists(),
                'views' => $blog->view_count
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function addComment(Request $req, $id_blog)
    {
        $req->validate(['comment' => 'required|string']);

        $account = Auth::user();
        $id_user = $account->user->id_user;

        $comment = new Comment([
            'user_id' => $id_user,
            'blog_id' => $id_blog,
            'comment' => $req->comment
        ]);
        $comment->save();

        // Tăng số lượng bình luận trong blog
        $blog = Blog::findOrFail($id_blog);
        $blog->increment('comment_count');

        return response()->json([
            'success' => true,
            'id' => $req->id,
            'comment' => $req->comment,
            'user' => [
                'fullname' => $account->user->fullname,
                'username' => $account->user->username,
                'img' => $account->user->img
            ],
            'time_diff' => $comment->getTimeDiff(),
            'commentCount' => $blog->comment_count
        ]);
    }

    public function getComments($id_blog)
    {
        $comments = Comment::where('blog_id', $id_blog)->orderBy('created_at', 'desc')->get();
        return view('partials.comments', compact('comments'));
    }
    public function deleteComment($id)
    {
        try {

            $comment = Comment::findOrFail($id);

            $blog = Blog::findOrFail($comment->blog_id);

            // Kiểm tra nếu người dùng là chủ của bình luận
            $account = Auth::user();
            $id_user = $account->user->id_user;
            if ($id_user !== $comment->user_id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $comment->delete();

            // Giảm số lượng bình luận trong blog
            $blog->decrement('comment_count');

            return response()->json(['success' => true, 'commentCount' => $blog->comment_count]);
        } catch (\Exception $e) {
            Log::error("Error deleting comment: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateComment(Request $request, $id)
    {
        try {
            $request->validate(['comment' => 'required|string']);

            $comment = Comment::findOrFail($id);

            // Kiểm tra nếu người dùng là chủ của bình luận
            $account = Auth::user();
            $id_user = $account->user->id_user;
            if ($id_user !== $comment->user_id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $comment->update([
                'comment' => $request->comment
            ]);

            return response()->json(['success' => true, 'comment' => $comment->comment]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
