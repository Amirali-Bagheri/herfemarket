<?php

namespace Modules\Notification\Http\Controllers\Site;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    public function index()
    {
        $user = User::query()->find(Auth::id());
        $unreadNotifications = $user->unreadNotifications;

        return view('notification::site.index', compact('unreadNotifications', 'user'));
    }
}
