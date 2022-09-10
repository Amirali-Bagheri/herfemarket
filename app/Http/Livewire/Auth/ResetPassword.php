<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;
use Modules\User\Entities\User;

class ResetPassword extends \Modules\Core\Http\Livewire\BaseComponent
{
    public $mobile;
    public $password;
    public $token;
    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function submit()
    {
        $this->validate([
            'mobile' => 'required|exists:users,mobile',
            'password' => 'required|confirmed',
        ]);

        $tokenData = DB::table('password_resets')->where('token', $this->token)->get();

        if (!$tokenData) {
            $this->redirect(route('password.request'));
        }

        $user = User::firstWhere('mobile', $this->mobile);

        if (!$user) {
            self::alert('error', 'کاربری با این تلفن همراه یافت نشد', [
                'position' => 'center',
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        }

        $user->update([
            'password' => $this->password,
        ]);

        $user->save();

        Auth::login($user);

        self::flash('success', 'رمز عبور شما با موفقیت تغییر کرد', [
            'position' => 'bottom-start',
            'toast' => true,
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

        $this->redirect('/');
    }

    public function render()
    {
        if (Agent::isMobile()) {
            return view('mobile.auth.passwords.reset')->extends('mobile.layouts.master', ['pageTitle' => 'تغییر کلمه عبور']);
        }
        return view('livewire.auth.reset-password')->extends('site.layouts.master', ['pageTitle' => 'تغییر کلمه عبور']);
    }
}
