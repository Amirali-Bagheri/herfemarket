<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;

class Login extends BaseComponent
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
    public $login_with_otp_show = false;
    public $layout;
    public $one_time_password;
    public $otp_1;
    public $otp_2;
    public $otp_3;
    public $code;
    public $otp_4;
    public $prevLink;
    public $listeners           = [
        'refreshComponent' => '$refresh',
    ];
    protected $queryString         = ['prevLink'];

    public function login_with_otp()
    {
//        $this->validate([
//            'mobile' => 'required',
//        ]);

        session()->put('mobile', $this->mobile);

        return redirect()->route('login.otp');
    }
    public function foregetPassword()
    {
//        $this->validate([
//            'mobile' => 'required',
//        ]);

        session()->put('mobile', $this->mobile);

        return redirect()->route('password.request');
    }

    public function mount()
    {
        // ini_set('xdebug.max_nesting_level', 10000);

        Meta::setTitleSeparator('-')->setTitle('ورود و ثبت نام')->prependTitle(Setting::get('seo_meta_title'));

        // dd(Auth::user());
        //
        // if (Auth::check()) {
        //     if (Auth::user()->google2fa_enable == true) {
        //         $this->redirect(route('2fa'));
        //     }
        //
        //     $this->redirect(route('dashboard'));
        // }

        /*        if (Agent::isMobile()) {

                    $build_id  = request()->header('build_id');
                    $user_md5  = request()->header('user_md5');
                    $first_use = request()->header('first_use');

                    $user = User::firstWhere('md5', $user_md5);
                    // $service = Service::firstWhere('slug', 'android');
                    $app = App::where('status', 1)->where('md5', $build_id)->first();

                    // dd($build_id,$user_md5,$first_use,$user,$app);

                    // dd($build_id,$first_use,$user_md5);$first_use == "true" and
                    if (isset($user->id, $build_id, $user_md5) and $user->id == $app->user_id) {
                        if ($app->auth_status != 'logged_out') {
                            Auth::login($user);
                        }
                        // $this->redirect(route('dashboard'));
                    }
                }*/
        /*        if (Agent::isMobile()) {
                    $post_data = request()->all();

                    $build_id = request()->header('build_id') ?? request()->query('build_id');
                    $user_md5 = request()->query('id');

                    $user = User::firstWhere('md5', $user_md5);

                    $app = App::where('md5', $build_id)->where('status', 1)->first();
                    if (isset($user->id) and $user->id == $app->user_id) {
                        // $bot = new Bot('1784859676:AAEahsVx8RgdBGC5847035xwc15x-7K8txY');
                        // $bot->sendMessage(new SendMessage('105627554', json_encode("Auth::login()")));

                        \Illuminate\Support\Facades\Auth::login($user);
                        $this->redirect(route('dashboard') . '?build_id=' . $build_id . '&id=' . $user_md5);
                    }
                }*/
    }

    public function login()
    {
        // if (!$this->login_with_otp_show) {
        $this->validate([
            'mobile'   => 'required',
            'password' => 'required',
        ]);
        //        if(\Auth::attempt(array('email' => convert2english($this->mobile), 'password' => $this->password))){
        //            session()->flash('message', "You are Login successful.");
        //        }else{
        //            session()->flash('error', 'email and password are wrong.');
        //        }

        //        $this->ensureIsNotRateLimited();

        // if ( ! auth()->attempt([
        //     'mobile'   => convert2english($this->mobile),
        //     'password' => $this->password,
        // ], $this->remember)) {
        //     //            RateLimiter::hit($this->throttleKey());
        //
        //     throw ValidationException::withMessages([
        //         'mobile' => __('auth.failed'),
        //     ]);
        // }

        $this->ensureIsNotRateLimited();

        if (Auth::attempt(['mobile' => convert2english($this->mobile), 'password' => $this->password,], $this->remember)) {
            RateLimiter::clear($this->throttleKey());
            $this->flash('success', 'ورود با موفقیت انجام شد', [
                'position'          => 'bottom-start',
                'timer'             => 3000,
                'toast'             => true,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]);

            // $link = $this->prevLink ?? '';
            $this->redirect(route('dashboard'));
        } else {
            RateLimiter::hit($this->throttleKey());
            $this->alert('error', 'خطا در ورود رخ داد', [
                'position'          => 'center',
                'timer'             => 3500,
                'toast'             => true,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]);

            throw ValidationException::withMessages([
                'mobile' => __('auth.failed'),
            ]);
        }

        // dd(Auth::user());
        //        dd('test');
        //
        //        RateLimiter::clear($this->throttleKey());
        //            $request->authenticate();
        //
        // request()->session()->regenerate();

        // $token = auth()->user()->createToken('YekiLink')->accessToken;

        // $token =  auth()->user()->createToken('API Token')->plainTextToken;

        // dd($token);

        /*
        $build_id = request()->query('build_id') ?? request()->header('build_id');
        if ($build_id and \Agent::isMobile()) {
            $app = App::firstWhere('md5', $build_id);

            if ($app and empty($app->user_id) and Auth::id()) {
                $app->update([
                    'user_id' => Auth::id(),
                ]);
            }

            $this->redirect(route('dashboard') . '?build_id=' . $build_id);
        } else {

        }
        */

        //        return redirect(RouteServiceProvider::HOME);
        //        return redirect()->route('site.index');

        //        $validatedDate = $this->validate([
        //            'mobile' => 'required',
        //            'password' => 'required',
        //        ]);
        //
        //        if (Auth::attempt(array('mobile' => convert2english($this->mobile), 'password' => $this->password))) {
        //            session()->flash('message', "You are Login successful.");
        //        } else {
        //            session()->flash('error', 'mobile and password are wrong.');
        //        }
        //        $user->update([
        //            'last_login_at' => Carbon::now()->toDateTimeString(),
        //            'last_login_ip' => $request->getClientIp()
        //        ]);

        // } else {
        /*
                    $user        = User::firstWhere('mobile', $this->mobile);
                    $verify_code = number_clean_format($this->otp_1) . number_clean_format($this->otp_2) .
                        number_clean_format($this->otp_3) . number_clean_format($this->otp_4);

                    $cache_otp_code = Cache::get('sms_id_code_' . $this->mobile);
                    if ($cache_otp_code = $verify_code) {
                        Auth::login($user, true);

                        $this->flash('success', 'ورود با موفقیت انجام شد', [
                            'position'          => 'bottom-start',
                            'timer'             => 3000,
                            'toast'             => true,
                            'showCancelButton'  => false,
                            'showConfirmButton' => false,
                        ]);

                        // $link = $this->prevLink ?? '';
                        $this->redirect(route('dashboard'));
                    } else {
                        $this->alert('error', 'کد وارد شده اشتباه است', [
                            'position'          => 'center',
                            'timer'             => 3000,
                            'toast'             => false,
                            'showCancelButton'  => false,
                            'showConfirmButton' => false,
                        ]);

                        // $path = parse_url($request->url(), PHP_URL_PATH);
                        // \session()->put('prevLink',$path);
                        //
                        // $link = $this->prevLink ?? '';
                        // $this->redirect(route('dashboard'));
                    }
                // }*/
    }

    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
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
        return Str::lower(convert2english($this->mobile)) . '|' . request()->ip();
    }

    public function render()
    {
        return view('auth.login')->extends('site.layouts.master', ['pageTitle' => 'ورود',]);
    }

//    public function googleSignin()
//    {
//        $this->redirect(Socialite::driver('google')->redirectUrl('https://panel.yekilink.com/login/google/callback')->redirect()
//                                 ->getTargetUrl());
//    }
//
//    public function facebookSignin()
//    {
//        config(['services.facebook.redirect' => env('FACEBOOK_LOGIN_REDIRECT_URI')]);
//
//        $this->redirect(Socialite::driver('facebook')->redirectUrl('https://panel.yekilink.com/login/facebook/callback/')
//                                 ->redirect()
//                                 ->getTargetUrl());
//    }
}
