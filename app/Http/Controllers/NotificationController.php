<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function createNotification($userId, $type, $content, $blogId = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'content' => $content,
            'blog_id' => $blogId,
            'is_read' => false,
        ]);
    }

    public function markAsRead($id) {
        $notification = Notification::find($id);
        if ($notification && $notification->user_id == auth()->id()) {
            $notification->update(['is_read' => true]);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }
}
