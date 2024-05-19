<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\User;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'approved')->orderBy('created_at', 'desc')->get();

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
        $blog_like = BlogLike::where("user_id", $account->user->id)->first();
        return view('home.blog', compact('blogs', 'followedUsers', 'followers', 'blog_like'));
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

        $id_user = $account->user->id;

        // Tạo blog mới
        $blog = Blog::create([
            'title' => $req->title,
            'content' => $req->content,
            'img' => $imagePath,
            'id_user' => $id_user,
            'status' => 'pending'
        ]);

        // Chuyển hướng về trang danh sách blog
        return redirect()->route('blog')->with('success', 'Blog has been sent to admin for approval');
    }
    public function approveBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 'approved';
        $blog->save();

        return redirect()->back()->with('success', 'Blog approved successfully!');
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
        $account = Auth::user();
        $blog_like = BlogLike::where("user_id", $account->user->id)->first();
        return view('blog.post', compact('blog', 'blog_like'));
    }
    public function deleteBlog($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Kiểm tra nếu người dùng là chủ của blog
            $account = Auth::user();
            $id_user = $account->user->id;
            if ($id_user !== $blog->id_user) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $blog->delete();

            return response()->json(['success' => true, 'content' => $blog->content]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deletePost($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Kiểm tra nếu người dùng là chủ của blog
            $account = Auth::user();
            $id_user = $account->user->id;
            if ($id_user !== $blog->id_user) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            $blog_like = BlogLike::where('blog_id', $blog->id)->delete();
            $blog->delete();
            // Trả về URL trước đó của trang blog
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateContent(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Kiểm tra quyền sở hữu blog
        $account = Auth::user();
        $id_user = $account->user->id;
        if ($id_user !== $blog->id_user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $blog->content = $request->content;
        $blog->save();

        return response()->json(['success' => true, 'content' => $blog->content]);
    }


    public function toggleLike($id)
    {
        $blog = Blog::findOrFail($id);
        $account = Auth::user();
        $user = $account->user;

        // Kiểm tra xem người dùng có tồn tại không trước khi tạo thông báo
        if ($user) {
            if ($user->likedBlogs()->where('id_blog', $id)->exists()) {
                $user->likedBlogs()->detach($id);
                $blog->decrement('like_count');
            } else {
                $user->likedBlogs()->attach($id);
                $blog->increment('like_count');
                $blog->increment('view_count');
            }

            // Tạo thông báo
            $notification = new Notification();
            $notification->user_id = $blog->id_user;
            $notification->type = 'like';
            $notification->data = $user->username . ' has liked your blog: ' . $blog->title;
            $notification->blog_id = $id;
            $notification->save();

            return response()->json([
                'success' => true,
                'likes' => $blog->likers()->count(),
                'liked' => $user->likedBlogs()->where('id_blog', $id)->exists(),
                'views' => $blog->view_count
            ]);
        } else {
            // Nếu người dùng không tồn tại, trả về một phản hồi lỗi hoặc xử lý theo cách thích hợp
            return response()->json([
                'success' => false,
                'error' => 'User not found'
            ], 404);
        }
    }
    public function addComment(Request $req, $id_blog)
    {
        $req->validate(['comment' => 'required|string']);

        $account = Auth::user();
        $id_user = $account->user->id;

        $comment = new Comment([
            'user_id' => $id_user,
            'blog_id' => $id_blog,
            'comment' => $req->comment
        ]);
        $comment->save();
        // Tăng số lượng bình luận trong blog
        $blog = Blog::findOrFail($id_blog);
        $blog->increment('comment_count');
        // Tạo thông báo
        $notification = new Notification();
        $notification->user_id = $blog->id_user;
        $notification->type = 'comment';
        $notification->data = $account->user->username . ' has comment your blog: ' . $req->comment;
        $notification->blog_id = $id_blog;
        $notification->save();

        return response()->json([
            'success' => true,
            'comment' => $req->comment,
            'user' => [
                'fullname' => $account->user->fullname,
                'username' => $account->user->username,
                'img' => $account->user->img
            ],
            'time_diff' => $comment->getTimeDiff(),
            'commentCount' => $blog->comment_count,
            'is_user_comment' => true,
            'comment_id' => $comment->id
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
            $id_user = $account->user->id;
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
            $id_user = $account->user->id;
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
