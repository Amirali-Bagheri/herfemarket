<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Facades\Agent;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Route;

class LoginRegister extends BaseComponent
{
    use ThrottlesLogins;
    use RegistersUsers;

    public $mobile;
    public $password;
    public $first_name;
    public $last_name;
    public $password_confirmation;
    public $remember;
    public $marketer_check;
    public $registerForm = false;
    public $layout;

    public function mount()
    {
        Meta::setTitleSeparator('-')->setTitle('ورود و ثبت نام')->prependTitle(Setting::get('seo_meta_title'));
    }

    public function login()
    {
        $this->validate([
            'mobile' => 'required',
            'password' => 'required',
        ]);
        try {
            //        if(\Auth::attempt(array('email' => $this->mobile, 'password' => $this->password))){
//            session()->flash('message', "You are Login successful.");
//        }else{
//            session()->flash('error', 'email and password are wrong.');
//        }

//        $this->ensureIsNotRateLimited();

            if (!Auth::attempt(array('mobile' => $this->mobile, 'password' => $this->password), $this->remember)) {
//            RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'mobile' => __('auth.failed'),
                ]);
            }
//        dd('test');
//
//        RateLimiter::clear($this->throttleKey());
//            $request->authenticate();
//
            request()->session()->regenerate();

            $this->flash('success', 'ورود با موفقیت انجام شد', [
                'position' => 'bottom-start',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

//            dd(auth()->user());
//        dd
//        return redirect()->route('site.index');


//        return redirect(RouteServiceProvider::HOME);
            return redirect()->route('site.index');

//        $validatedDate = $this->validate([
//            'mobile' => 'required',
//            'password' => 'required',
//        ]);
//
//        if (Auth::attempt(array('mobile' => $this->mobile, 'password' => $this->password))) {
//            session()->flash('message', "You are Login successful.");
//        } else {
//            session()->flash('error', 'mobile and password are wrong.');
//        }
//        $user->update([
//            'last_login_at' => Carbon::now()->toDateTimeString(),
//            'last_login_ip' => $request->getClientIp()
//        ]);
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }


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

    public function throttleKey()
    {
        return Str::lower($this->mobile) . '|' . request()->ip();
    }

    public function register()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'required|max:12|regex:/[0-9]{10}/|digits:11|unique:users,mobile',
            'password' => 'required|min:6|confirmed',
            // 'captcha' => 'required|captcha',
        ]);

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'password' => $this->password,
        ]);

        if ($this->marketer_check == 1) {
            $user->assignRole('member', 'marketer');
            $user->status = 0;
        } else {
            $user->assignRole('member');
        }

        $this->guard()->login($user);

        $this->flash('success', 'ثبت نام با موفقیت انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

//        return $this->registered(request(), $user) ?: redirect($this->redirectPath());
        $this->redirect(route('site.index'));

//        $userData = [
//            'first_name' => $data['first_name'],
//            'last_name' => $data['last_name'],
//            'mobile' => $data['mobile'],
//            'password' => $data['password'],
//        ];
//        if ($data['form_user']) {
//            return "form_user";
//        }
//
//        if ($data['form_marketer']) {
//            return "form_marketer";
//        }
//        $this->password = Hash::make($this->password);

//        User::create(['name' => $this->name, 'mobile' => $this->mobile, 'password' => $this->password]);

//        session()->flash('message', 'Your register successfully Go to the login page.');
    }

    public function render()
    {
        if (!Agent::isMobile()) {
//            return view('auth.login');
            return view('livewire.auth.login-register')->extends('site.layouts.master');
        }
        if (Route::is('register')) {
            return view('mobile.auth.register')->extends('mobile.layouts.master');
        }
        return view('mobile.auth.login')->extends('mobile.layouts.master');
    }

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->mobile = '';
        $this->password = '';
        $this->password_confirm = '';
    }
}
