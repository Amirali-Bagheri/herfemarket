<?php

namespace App\Http\Livewire\Auth;

use Agent;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;

class Register extends BaseComponent
{
    use ThrottlesLogins;
    use RegistersUsers;

    public $mobile;
    public $password;
    public $name;
    public $first_name;
    public $last_name;
    public $password_confirmation;
    public $recaptcha;
    public $ref;

    public $register_business;
    public $is_register_business;

    public function mount()
    {
        Meta::setTitleSeparator('-')->setTitle('ثبت نام')->prependTitle(Setting::get('seo_meta_title'));

        $this->ref = request()->query('ref');


        $this->register_business = session('register_business');
        $this->is_register_business = !empty($this->register_business);
    }

    public function render()
    {
        return view('auth.register')->extends('site.layouts.master', [
                'pageTitle' => 'ثبت نام',
            ]);
    }

    /**
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'mobile' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->mobile) . '|' . request()->ip();
    }

    public function register()
    {
        $this->validate([
            'mobile' => 'required|max:12|regex:/[0-9]{10}/|digits:11|unique:users,mobile',
//            'mobile' => 'required|max:12|regex:/[0-9]{10}/|digits:11|unique:users,mobile,NULL,id,deleted_at,NULL',
        ]);

        $user = User::create([
            // 'name'     => $this->name,
            // 'name'     => $this->first_name ?? null . ' ' . $this->last_name ?? null,
            'mobile' => $this->mobile,
            // 'password' => $this->password,
            'referer' => $this->ref ?? null,
        ]);

        $user->assignRole('member');
//
//        $plan_free = Plan::firstWhere('slug', 'free');
//        $user->newSubscription('main', $plan_free);

        $this->guard()->login($user);

        if ($this->is_register_business) {
            $this->flash('success', 'ثبت نام با موفقیت انجام شد', [
                'position' => 'bottom-start',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
            if ($this->register_business == 'offline_business') {
                $this->redirect(route('register.offline.business'));
            } elseif ($this->register_business == 'online_business') {
                $this->redirect(route('register.online.business'));
            } else {
                $this->redirect(route('dashboard.index'));
            }
        } else {
            $this->flash('success', 'ثبت نام با موفقیت انجام شد', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

            $this->redirect(route('dashboard.index'));
        }
    }

}
