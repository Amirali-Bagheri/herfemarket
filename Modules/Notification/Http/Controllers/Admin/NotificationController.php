<?php

namespace Modules\Notification\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationController extends Controller
{
    public function markRead(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return back();
    }

    public function markAllRead(Request $request)
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return back();
    }

    public function index()
    {
        //        return view('notification::index');
    }

    public function create()
    {
    }

    public function destroy($id)
    {
        //
    }
}
