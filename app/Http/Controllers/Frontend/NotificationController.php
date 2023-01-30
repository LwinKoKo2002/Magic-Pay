<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->guard('web')->user();
        $notifications = $user->notifications()->paginate(6);
        $unread_noti_count = $user->unreadNotifications()->count();
        return view('frontend.notification.index', [
            'notifications'=>$notifications,
            'unread_noti_count'=>$unread_noti_count
        ]);
    }

    public function show($noti_id)
    {
        $user = auth()->guard('web')->user();
        $notification = $user->notifications()->firstWhere('id', $noti_id);
        $notification->markAsRead();
        return view('frontend.notification.show', [
            'notification'=>$notification
        ]);
    }
    
    public function destroy($noti_id)
    {
        $user = auth()->guard('web')->user();
        $notification = $user->notifications()->firstWhere('id', $noti_id);
        $notification->delete();
        return "success";
    }

    public function unReadNotiUpdate($noti_id)
    {
        $user = auth()->guard('web')->user();
        $notification = $user->notifications()->firstWhere('id', $noti_id);
        $notification->markAsRead();
        return "success";
    }

    public function readNotiUpdate($noti_id)
    {
        $user = auth()->guard('web')->user();
        $notification = $user->notifications()->firstWhere('id', $noti_id);
        $notification->read_at = null;
        $notification->update();
        return "success";
    }
}
