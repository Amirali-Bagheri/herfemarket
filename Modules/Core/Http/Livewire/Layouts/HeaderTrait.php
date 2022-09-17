<?php

namespace Modules\Core\Http\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Support\Authenticator;

trait HeaderTrait
{
    // public $listeners = [
    //     'refreshComponent' => '$refresh',
    //     'changeThemeDark'     => 'changeThemeDark',
    // ];

    public $notifications;

    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications ?? [];
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function change_language()
    {
        // App::setLocale($request->lang);
        // session()->put('locale', $request->lang);
    }

    public function changeThemeDark()
    {
        if (session()->get('isDark')) {
            session()->put('isDark', false);
        } else {
            session()->put('isDark', true);
        }

        $this->dispatchBrowserEvent('refresh-page');
    }

    public function markNotifications()
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        $this->alert('success', 'همه اعلانات خوانده شد', [
            'toast' => true,
            'position' => 'bottom-start',
            'showConfirmButton' => false,
            'timer' => 3000,
            'timerProgressBar' => true,
        ]);

        $this->dispatchBrowserEvent('refresh-page');
    }

    public function readNotification($notification_id)
    {
        $notification = auth()->user()->notifications()->find($notification_id);
        if (!$notification) {
            return;
        }
        $notification->markAsRead();

        if (! empty($notification->data['link'])) {
            $this->redirect($notification->data['link']);
        }
    }
}
